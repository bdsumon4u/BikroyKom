<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $_start = Carbon::parse(\request('start_d'));
        $start = $_start->format('Y-m-d');
        $_end = Carbon::parse(\request('end_d'));
        $end = $_end->format('Y-m-d');

        $productsCount = Product::count();
        $orderQ = Order::query()->whereBetween('created_at', [$_start->startOfDay()->toDateTimeString(), $_end->endOfDay()->toDateTimeString()]);
        $orders = ['Total' => (clone $orderQ)->count()];
        foreach (config('app.orders', []) as $status) {
            if ($status == 'Shipping') {
                $orders[$status] = Order::query()
                    ->whereBetween('shipped_at', [$_start->startOfDay()->toDateTimeString(), $_end->endOfDay()->toDateTimeString()])
                    ->where('status', $status)
                    ->count();
                continue;
            }
            $orders[$status] = (clone $orderQ)->where('status', $status)->count();
        }
        $inactiveProducts = Product::whereIsActive(0)->get();
        $outOfStockProducts = Product::whereShouldTrack(1)->where('stock_count', '<=', 0)->get();
        return view('admin.dashboard', compact('productsCount', 'orders', 'inactiveProducts', 'outOfStockProducts', 'start', 'end'));
    }
}
