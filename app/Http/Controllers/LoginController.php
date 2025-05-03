<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {
            // Check if the user is an admin
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'تم تسجيل الدخول بنجاح.');
            }

            // Redirect to the home page for regular users
            return redirect()->route('home')->with('success', 'تم تسجيل الدخول بنجاح.');
        }

        // If login attempt fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.',
        ]);
    }

    protected function redirectTo()
    {
        return session()->get('url.intended', '/home'); // إعادة التوجيه إلى الرابط المخزن أو إلى الصفحة الرئيسية
    }
}