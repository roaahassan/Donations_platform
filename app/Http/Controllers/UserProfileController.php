<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    /**
     * عرض صفحة البروفايل.
     */
    public function profile()
    {
        return view('admin.profile');
    }

    /**
     * تحديث بيانات البروفايل.
     */
    public function updateProfile(Request $request)
    {
        // Validate the incoming request data
    $validatedData = $request->validate([
        'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
        'phone' => 'required|string|max:15',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    // Update the authenticated user's profile
    $user = auth()->user();
    $user->update([
        'email' => $validatedData['email'],
        'phone' => $validatedData['phone'],
        'password' => isset($validatedData['password']) ? bcrypt($validatedData['password']) : $user->password,
    ]);

    // Redirect back with a success message
    return redirect()->route('user.profile')->with('success', 'تم البيانات الشخصية بنجاح.');
    }
}