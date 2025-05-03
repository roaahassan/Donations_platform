<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // عرض صفحة تسجيل الأدمن
    public function showAdminRegisterForm(Request $request)
    {
        // التحقق من رمز الحماية
        if ($request->input('access_code') !== 'SECRET_CODE') {
            return response('رمز الحماية غير صحيح.', 403);
        }

        return view('admin.admin_register');
    }

    // تسجيل الأدمن
    public function registerAdmin(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'security_code' => 'required|string', // رمز الحماية
        ]);

        // التحقق من رمز الحماية
        if ($request->input('security_code') !== '12345') { // استبدل '12345' بالرمز الصحيح
            abort(404, 'الصفحة غير موجودة'); // إرجاع صفحة 404
        }

        // إنشاء المستخدم كأدمن
        User::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'admin', // تعيين الدور كأدمن
        ]);

        return redirect()->route('login')->with('success', 'تم إنشاء حساب الأدمن بنجاح.');
    }
}