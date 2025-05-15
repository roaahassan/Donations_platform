<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // التحقق من صحة المدخلات
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ] , [
            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'البريد الإلكتروني غير صالح.',
            'password.required' => 'كلمة المرور مطلوبة.',
            'password.min' => 'يجب أن تكون كلمة المرور 6 أحرف على الأقل.',
        ]);

        // محاولة تسجيل الدخول
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();

        if($user->role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        } else {
            return redirect('/check-redirect');
        }
    }
        // التحقق من وجود البريد الإلكتروني
        // if (!Auth::attempt(['email' => $request->email])) {
        //     return back()->withErrors([
        //         'email' => 'البريد الإلكتروني غير موجود.'
        //     ])->withInput();
        // }
        if (!\App\Models\User::where('email', $request->email)->exists()) {
            return back()->withErrors([
                'email' => 'البريد الإلكتروني غير موجود.',
            ])->withInput();
        }

        // التحقق من كلمة المرور
        return back()->withErrors([
            'password' => 'كلمة المرور غير صحيحة.',
        ])->withInput();
    }

    protected function authenticated(Request $request, $user)
    {
         // تحقق مما إذا كان هناك معرف حوجة مخزن في Local Storage
        // if ($request->has('redirect_to_donation')) {
        //     $needId = $request->input('redirect_to_donation');
        //     return redirect()->route('donate.show', ['needId' => $needId]);
        // }

       // إذا لم يكن هناك إعادة توجيه، أعد المستخدم إلى الصفحة الرئيسية
       return redirect()->intended('/'); 
    }
}