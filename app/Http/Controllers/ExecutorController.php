<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderFulfillment;
use App\Models\Response;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 

class ExecutorController extends Controller
{
    public function create(): View
    { 
        $title = 'Регистрация исполнителя';
        $parent = ['title' => 'Регистрация', 'url' => "/register"];
        return view('auth.register', compact('title', 'parent'));
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
        $user->executor()->create([
            'last_name' => $request->last_name,
            'job_title' => $request->job_title,
            'direction' => $request->direction,
        ]);

        event(new Registered($user)); 
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function sendResponse(Request $request){
        $data = $request->all();
        $data['user_id'] = Auth::id();
        if((int)$data['order_user_id'] === Auth::id()) return back()->with('error', 'Вы не можете оставлять отклик на свои заказы');
        Response::create($data);
        return redirect()->route('lk.responses')->with('success', 'Вы успешно отправили отклик');
    }

    public function responses(){
        $responses = Response::with('order')->where('user_id', Auth::id())->latest()->get();
        $parent = ['url' => '/personal', 'title'=> 'Личный кабинет'];
        $title = 'Отправленные отклики';
        return view('lk.responses', compact('responses', 'title', 'parent'));
    }

    public function tasks(){
        $parent = ['url' => '/personal', 'title'=> 'Личный кабинет'];
        $title = 'Взятые заказы';
        $tasks = Order::with('files')->where('executor_id', Auth::id())->get();
        return view('lk.tasks', compact('tasks', 'parent', 'title'));
    }

    public function fulfillment(Order $order){
        if($order->executor_id === Auth::id()):
            $order->load('files', 'fulfillment', 'customer', 'executor');
            if(!$order->fulfillment):
                $order->fulfillment()->create(['user_id' => Auth::id(), 'order_id' => $order->id, 'status' => OrderFulfillment::STATUS_IN_PROGRESS]);
            endif;
            $parent = ['url' => '/orders/all', 'title'=> 'Заказы'];
            $title = "Выполнение заказа";
    
            return view('orders.fulfillment', compact('order', 'title', 'parent'));
        endif;
        return abort(403);
    }

    public function remove(Response $response){ 
        if($response->user_id === Auth::id()):
            
            $response->delete();
            return back()->with('success', 'Отклик успешно отозван');
        else:
            return abort(403);
        endif;

    }
}
