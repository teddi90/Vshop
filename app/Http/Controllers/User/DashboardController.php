<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $orders = Order::where('created_by', $userId)
            ->with('order_items.product.brand', 'order_items.product.category')
            ->get();
        return Inertia::render('User/Dashboard',['orders'=>$orders]);
    }
}
