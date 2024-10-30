<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider; 
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    public function edit(){
        $parent = ['url' => '/personal', 'title'=> 'Личный кабинет'];
        $title = 'Профиль пользователя';
        return view('lk.edit', compact('parent', 'title'));
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());
        $request->validate([
            'name' => [ 'string', 'max:255'],
            'email' => ['string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)], 
            'password' => ['nullable','confirmed', 'string', 'min:6'],
        ]); 
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password):
            $user->password = Hash::make($request->password);
        endif; 
        $user->save();
        return back()->with('success', 'Данные пользователя изменены');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', 'string', 'min:6'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
