<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function showLogoutButton(){
        return view('logout');
    }

    public function logout(){
        
        Auth::logout();
        return redirect()->route('login');
    }
}
