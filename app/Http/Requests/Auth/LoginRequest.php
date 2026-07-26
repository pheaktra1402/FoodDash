<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];

    }
    public function store(): array{
        return[
            'email.required' => 'Please enter your email',
            'email.email' => 'Invalid email',
            'password.required' => 'Please enter your password',
            'password.password' => 'Password is incorrect'
        ];
    }
    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        // 1. Checks if the user tried to log in too many times. 
    // Stops them if they are temporarily locked out.
        $this->ensureIsNotRateLimited();
        //Check if the user exists
        $user = \App\Models\User::where('email', $this->input('email'))->first();
        if(!$user){
        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => 'Email not found',
        ]);
        }
  
        //User exists, now check if the password matches
        if(!\Illuminate\Support\Facades\Hash::check($this->input('password'), $user->password)){
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'password' => 'Password is incorrect'
            ]);
        }
        Auth::login($user , $this->boolean('remember'));
        //If successful, clear the failed attempt counter.
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
