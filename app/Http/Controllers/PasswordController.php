<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function showForm()
    {
        return view('password_form');  
    }

    public function checkPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);
 
        if ($request->password === '210794') {
            $request->session()->put('password_entered', true);
            return redirect()->intended('/');
        }

        return back()->withErrors(['password' => 'Неверный пароль.']);
    }
}
