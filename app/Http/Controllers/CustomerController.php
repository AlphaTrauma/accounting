<?php

namespace App\Http\Controllers;

use App\Models\CustomerProfile;
use App\Models\Order;
use App\Models\OrderFulfillment;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 

class CustomerController extends Controller
{
    public function create(): View
    { 
        $title = 'Регистрация заказчика';
        return view('auth.customer-register', compact('title'));
    }


    public function edit(){
        $parent = ['url' => '/personal', 'title'=> 'Личный кабинет'];
        $title = 'Профиль заказчика';
        return view('lk.customer_edit', compact('parent', 'title'));
    }

    public function update(Request $request){
        $request->validate([
            'last_name' => ['nullable', 'string', 'max:255'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'direction' => ['nullable', 'string', 'max:255'],
        ]);
        $customer = CustomerProfile::where('user_id', Auth::id())->first();
        $customer->update($request->except('_token'));
        return back()->with('success', 'Профиль заказчика успешно изменён');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    { 
        $request->validate([
            'last_name' => ['nullable', 'string', 'max:255'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'direction' => ['nullable', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', 'string', 'min:6'],
        ]);   
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]); 
        $user->customer()->create([
            'last_name' => $request->last_name,
            'job_title' => $request->job_title,
            'direction' => $request->direction,
        ]);

        event(new Registered($user)); 
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function orders(Request $request){
        if($request->has('status')):
            $active = $request->input('status');
        else:
            $active = Order::STATUS_OPEN;
        endif;
        $orders = Order::withCount('files', 'responses')
            ->where(['user_id' => Auth::id(), 'status' => $active])
            ->get();
        
        $statuses = Order::getStatuses();
        $parent = ['url' => '/personal', 'title'=> 'Личный кабинет'];
        $title = 'Размещённые заказы';
        return view('lk.orders', compact('orders', 'statuses', 'active', 'parent', 'title'));
    }

    public function result(Order $order){
        if($order->user_id === Auth::id()):
            $order->load('files', 'fulfillment', 'customer', 'executor');
            if(!$order->fulfillment):
                $order->fulfillment()->create(['user_id' => $order->executor_id, 'order_id' => $order->id, 'status' => OrderFulfillment::STATUS_IN_PROGRESS]);
            endif;
            $parent = ['url' => '/personal/orders', 'title'=> 'Ваши заказы'];
            $title = "Выполнение заказа";
    
            return view('orders.result', compact('order', 'title', 'parent'));
        endif;
        return abort(403);   
    }
}
