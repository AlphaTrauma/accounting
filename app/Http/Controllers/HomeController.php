<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){ 
        $orders = Order::withCount('files', 'responses')->where('status', Order::STATUS_OPEN)->latest()->limit(6)->get();
        return view('index', compact('orders'));
    }

    public function personal(){ 
        $title = 'Личный кабинет';
        $lastOrder = $lastTask = null;
        $lastOrder = Order::withCount('files', 'responses')->where('user_id', Auth::id())->latest()->first();
        $lastTask = Order::withCount('files')->where('executor_id', Auth::id())->latest()->first();

        return view('LK.index', compact('title', 'lastOrder', 'lastTask'));
    }
}
