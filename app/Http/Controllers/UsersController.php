<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class UsersController extends Controller
{
    public function index(Request $request){ 
        $users = User::query()->when($request->has('type'), function($q) use ($request) {
            $q->whereHas($request['type']);
        })->when($request->has('query'), function($q) use ($request){
            $q->where('name', 'like', "%".$request['query']."%")->orWhere('email', 'like', "%".$request['query']."%");
        })->with('executor', 'customer', 'admin', 'session')->paginate(50);
         
        return view('dashboard.users.index', compact('users'));
    }

    public function addRole(Request $request){
        if($request['user_id'] and $request['role']):
            if($request['role'] === 'admin'):
                $user = User::find($request['user_id']);
                $user->admin()->create(['rights' => 'full', 'job_title' => 'Администратор']);
                return back()->with('success', 'Пользователю выданы права админа');
            endif;
        endif;
        return back()->with('error', 'У вас нет прав');
    }
}