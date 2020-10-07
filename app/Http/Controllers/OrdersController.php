<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function index(){
        $user_id = Auth::id();
        $orders = Order::where('user_id', $user_id)
            ->where('show', 'yes')
            ->get();

        return response($orders);
    }

    public function loadTable()
    {

        $users = Order::orderBy('id','asc')
            ->where('show', 'yes')
            ->get();

        return response($users);

    }

    public function delete(Request $request)
    {

        if($request->ajax()) {

            $user = Order::where('id', $request->id)->update(['show' => 'no']);

            return response()->json($user);
        }

    }
}
