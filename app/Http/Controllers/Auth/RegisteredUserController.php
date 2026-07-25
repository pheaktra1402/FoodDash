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
            Password::min(8)
                // ->letters()
                // ->numbers()
                // ->symbols()
        ],
        // 1. Move confirmation rule here so errors attach to password_confirmation key
        'password_confirmation' => ['required', 'same:password'],
    ], [
        // Custom Messages
        'name.required' => 'Please enter your username.',
        'name.min' => 'Name must be more than 3 characters.',
        'name.regex' => 'Name cannot contain numbers or symbols.',
        'email.required' => 'Please enter email address.',
        'email.email' => 'Invalid email format (e.g. example@gmail.com).',
        'email.unique' => 'Email already exists.',
        'password.required' => 'Please enter your password.',
        // 2. Target password_confirmation.same here
        'password_confirmation.required' => 'Please confirm your password.',
        'password_confirmation.same' => 'Confirm password does not match.',
    ]);

    $user = User::create([
        'name' => trim($request->name),
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' =>'user'
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect(route('dashboard', absolute: false));
}
}