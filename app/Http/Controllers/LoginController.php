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

    // protected function redirectTo()
    // {
    //     return session()->get('url.intended', '/home'); // إعادة التوجيه إلى الرابط المخزن أو إلى الصفحة الرئيسية
    // }

    protected function authenticated(Request $request, $user)
    {
        
            // تحقق مما إذا كان هناك معرف حوجة مخزن في الجلسة
            if (session()->has('redirect_to_donation')) {
                $needId = session('redirect_to_donation');
                session()->forget('redirect_to_donation'); // احذف القيمة من الجلسة
                return redirect()->route('donate.show', ['needId' => $needId]);
            }
        
            // إذا لم يكن هناك إعادة توجيه، أعد المستخدم إلى الصفحة الرئيسية
            return redirect()->intended('/'); // يعيد المستخدم إلى الصفحة التي حاول الوصول إليها
    }
}