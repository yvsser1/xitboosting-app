<?php

namespace App\Http\Controllers;

use App\About;
use App\Faq;
use App\Gallery;
use App\Leagues;
use App\Order;
use App\Queue;
use App\Server;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{

    public function index(Request $request)
    {
        $active_url = $request->route('id');

        $activeUser = 0;
        if(!empty($active_url)){
            $this->activeUser($active_url);
            $activeUser = 1;
        }

        $servers = Server::all();

        $user_id = Auth::id();
        $orders = Order::where('user_id', $user_id)->get();

        $leagues = Leagues::all();

        $queues = Queue::all();

        $about = About::first();

        $gallerys = Gallery::all();

        $faqs = Faq::all();

        return view('layouts.index', compact('gallerys','faqs', 'about', 'servers', 'leagues', 'queues', 'orders', 'activeUser'));

    }

    public function activeUser($active_url){
        User::where('active_url', $active_url)
            ->where('active', 0)
            ->update(['active' => 1]);
    }

}
