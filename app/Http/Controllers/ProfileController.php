<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile');
    }
public function update(Request $request)
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
    return redirect()->route('profile.index')->with('success', 'تم تحديث البيانات الشخصية بنجاح.');
}

}