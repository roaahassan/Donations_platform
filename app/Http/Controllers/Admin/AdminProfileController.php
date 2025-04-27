<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    public function index()
    {
        // جلب الإشعارات الخاصة بالمستخدم الحالي
        $notifications = Auth::user()->notifications()->latest()->get();

        return view('admin.profile', compact('notifications'));
    }

    public function update(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
        'password' => 'required|string',
    ]);

    $user = auth()->user();
    $user->update([
        'email' => $request->email,
        'password' => $request->password,
    ]);

    return redirect()->route('profile')->with('success', 'تم تحديث البيانات الشخصية بنجاح.');
}

}





