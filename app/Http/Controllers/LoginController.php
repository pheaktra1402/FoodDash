<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
      
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // ... rest of your login logic (e.g., Auth::attempt(...))
    }
}