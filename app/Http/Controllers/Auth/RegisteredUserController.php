<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        // Advanced Validation Rule
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:50', 'regex:/^[a-zA-Z\s\x{01780}-\x{017FF}]+$/u'],
            'email' => ['required', 'string', 'lowercase', 'email:rfc,dns', 'max:255', 'unique:'.User::class],
            'password' => [
                'required', 
                'confirmed', 
                Password::min(8)
                    // ->letters()
                    // ->numbers()
                    // ->symbols()
            ],
        ], [
            // Custom Messages
            'name.required' => 'Please enter your username',
            'name.min' => 'Name must more than 3 charecter',
            'name.regex' => 'Name can not contail number or symbol',
            'email.required' => 'Please enter email address',
            'email.email' => 'Invalid email format.(example@gmail.com)',
            'email.unique' => 'Email already exist',
            'password.required' => 'Please enter your password',
            'password.confirmed' => 'Confirm password not match',
        ]);

        $user = User::create([
            'name' => trim($request->name),
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}