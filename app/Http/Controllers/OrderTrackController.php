<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderTrackController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (! $request->has('order')) {
            return view('track-order');
        }
        $order = Order::where(['id' => $request->order, 'phone' => $request->phone])
            ->first();
        return $order instanceof Order
            ? view('order-status', compact('order'))
            : back()->withDanger('Invalid Tracking Info Or Order Record Was Deleted.');
    }
}
