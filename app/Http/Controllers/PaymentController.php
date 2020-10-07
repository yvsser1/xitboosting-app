<?php

namespace App\Http\Controllers;

use App\CoachingPrice;
use App\DuoPrice;
use App\Order;
use App\ServicePrice;
use App\SoloPrice;
use App\WinPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;

class PaymentController extends Controller
{
	private $_api_context;

	public function index(){
        return view('welcome');
    }

    public function __construct()
    {
		/** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
	}

	public function payWithpaypal(Request $request)
    {

        if (!Auth::check()) {
            \Session::put('error', 'You are not authorized. Please log in!');
            return Redirect::route('/');
        }

        if (Auth::user()->active == 0) {
            \Session::put('error', 'You are not verified user, please verify your e-mail!');
            return Redirect::route('/');
        }

        $servicePrice = ServicePrice::where('service',$request->service)
            ->first();

        if(!$servicePrice){
            \Session::put('error', 'Chack all selector!');
            return Redirect::route('/');
        }

        if($request->type == 'coaching')
        {
            $coachingPrice = CoachingPrice::where('rank',$request->rank)
                ->where('hours',$request->hours)
                ->first();

            if(!$coachingPrice){
                \Session::put('error', 'Chack all selector!');
                return Redirect::route('/');
            }

            $price = $coachingPrice->price + ($coachingPrice->price * $servicePrice->price / 100);

            if($price == 0){
                \Session::put('error', 'Chack all selector!');
                return Redirect::route('/');
            }
        }
        else if($request->type == 'solo')
        {
            $soloPrice = SoloPrice::where('now_league_id',$request->now_league_id)
                ->where('now_division_id',$request->now_division_id)
                ->where('next_league_id',$request->next_league_id)
                ->where('next_division_id',$request->next_division_id)
                ->first();

            if(!$soloPrice){
                \Session::put('error', 'Chack all selector!');
                return Redirect::route('/');
            }

            $price = $soloPrice->price + ($soloPrice->price * $servicePrice->price / 100);

            if($price == 0){
                \Session::put('error', 'Chack all selector!');
                return Redirect::route('/');
            }
        }
        else if($request->type == 'duo')
        {
            $duoPrice = DuoPrice::where('now_league_id',$request->now_league_id)
                ->where('now_division_id',$request->now_division_id)
                ->where('next_league_id',$request->next_league_id)
                ->where('next_division_id',$request->next_division_id)
                ->first();

            if(!$duoPrice){
                \Session::put('error', 'Chack all selector!');
                return Redirect::route('/');
            }

            $price = $duoPrice->price + ($duoPrice->price * $servicePrice->price / 100);

            if($price == 0){
                \Session::put('error', 'Chack all selector!');
                return Redirect::route('/');
            }
        }
        else if($request->type == 'win')
        {
            $winPrice = WinPrice::where('now_league_id',$request->now_league_id)
                ->where('now_division_id',$request->now_division_id)
                ->where('games',$request->games)
                ->first();

            if(!$winPrice){
                \Session::put('error', 'Chack all selector!');
                return Redirect::route('/');
            }

            $price = $winPrice->price + ($winPrice->price * $servicePrice->price / 100);

            if ($request->game_service == 'duo') {
                $price = $price * 2;
            }

            if($price == 0){
                \Session::put('error', 'Chack all selector!');
                return Redirect::route('/');
            }
        }

		$payer = new Payer();
        $payer->setPaymentMethod('paypal');

		$item_1 = new Item();
		$item_1->setName('Item 1') /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($price); /** unit price **/

		$item_list = new ItemList();
        $item_list->setItems(array($item_1));

		$amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($price);

		$transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

		$redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('status')) /** Specify return URL **/
            ->setCancelUrl(URL::route('status'));

		$payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/

        try {

			$payment->create($this->_api_context);

		} catch (\PayPal\Exception\PPConnectionException $ex) {

			if (\Config::get('app.debug')) {

				\Session::put('error', 'Connection timeout');
                return Redirect::route('paywithpaypal');

			} else {

				\Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::route('paywithpaypal');

			}

		}

		foreach ($payment->getLinks() as $link) {

			if ($link->getRel() == 'approval_url') {

				$redirect_url = $link->getHref();
	            break;

			}

		}

		/** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
		if (isset($redirect_url)) {

		    // Add Order
            $this->addOrder($request, $payment->getId(), $price);

			/** redirect to paypal **/
            return Redirect::away($redirect_url);

		}

		\Session::put('error', 'Unknown error occurred');
	    return Redirect::route('paywithpaypal');
	}

	public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
 
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
 
            \Session::put('error', 'Payment failed');
            return Redirect::route('/');
 
        }
 
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
 
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
 
        if ($result->getState() == 'approved') {

            Order::where('paypal_id', $payment_id)
                ->update(['status' => 'process','pay_status' => 'yes']);
            \Session::put('success', 'Payment success');
            return Redirect::route('/');
 
        }
 
        \Session::put('error', 'Payment failed');
        return Redirect::route('/');
 
    }

    public function addOrder($request, $paypal_id, $price)
    {
        $user_id = Auth::id();
        $order = new Order;

        $order->user_id = $user_id;
        $order->paypal_id = $paypal_id;
        $order->type = $request->type;
        $order->service = $request->service;
        $order->line = $request->line;
        $order->rank = $request->rank;
        $order->server_id = $request->server_id;
        $order->hours = $request->hours;
        $order->now_league_id = $request->now_league_id;
        $order->now_division_id = $request->now_division_id;
        $order->next_league_id = $request->next_league_id;
        $order->next_division_id = $request->next_division_id;
        $order->queue_id = $request->queue_id;
        $order->game_service = $request->game_service;
        $order->games = $request->games;
        $order->price = $price;

        $order->save();
    }
}
