<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{

    public function main(){
        $orders = Order::withCount('files', 'responses')->where('status', Order::STATUS_OPEN)->paginate(20);
        $title = 'Заказы';
        return view('orders.main', compact('orders', 'title'));
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->paginate(20);
        $parent = ['url' => '/personal', 'title'=> 'Личный кабинет'];
        $title = 'Размещённые заказы';
        return view('LK.orders', compact('orders', 'title', 'parent'));
    }

    public function create()
    {
        $parent = ['url' => '/orders/all', 'title'=> 'Заказы'];
        $title = 'Создание заказа';
        return view('orders.create', compact('title', 'parent'));
    }

    public function store(Request $request)
    {
        # TODO OrderRequest
        $order = Order::create($request->all());
        
        return redirect()->route('orders.publish', compact('order'));
    }

    public function publish(Order $order){

        $order->load('files'); 

        switch($order->status):
            case(Order::STATUS_CREATED):
            case(Order::STATUS_STOPPED):
                $newStatus = Order::STATUS_OPEN;
                break;
            default:
                $newStatus = Order::STATUS_STOPPED;
        endswitch;
        $newStatus = [$newStatus => Order::getStatusCommands()[$newStatus]];
        
        return view('orders.publish', compact('order', 'newStatus'));
    }

    public function show(Order $order)
    {
        $order->load('user.customer')->loadCount('files', 'responses');
        if($order->user):
            $order->user->loadCount('orders');
        endif;
        $hasResponse = Response::where(['user_id' => Auth::id(), 'order_id' => $order->id])->count() > 0;
        $parent = ['url' => '/orders/all', 'title'=> 'Заказы'];
        $title = 'Заказ #'.$order->id;

        return view('orders.show', compact('order', 'hasResponse', 'title', 'parent'));
    }

    public function orderResponses(Order $order){
        $order->load('responses.user');
        $responses = $order->responses;
        $active = $order->executor_id ?? null;

        return response(compact('responses', 'active'));
    }

    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    { 
        $order->update($request->all()); 

        return redirect()->route('lk.orders')->with('message', 'Заказ обновлён');
    }

    public function confirm(Response $response){
        $response->load('order');
        if($response->order and $response->order->user_id === Auth::id()):
            $response->order->update(['executor_id' => $response->user_id, 'status' => Order::STATUS_IN_PROGRESS]);
            # TODO dispatch
            return back()->with('success', 'Заявка успешно принята, заказ передан в работу');
        endif;
        return back()->with('error', 'Ошибка принятия отклика');
        
    }

    public function destroy(Order $order)
    {
        if($order->user_id === Auth::id() && in_array($order->status, [Order::STATUS_CREATED, Order::STATUS_OPEN, Order::STATUS_STOPPED])):
            $order->delete();
            return redirect()->route('lk.orders')->with('success', 'Заказ удалён'); 
        else:
            return redirect()->route('lk.orders')->with('error', 'Вы не можете удалить этот заказ'); 
        endif; 
    }
}
