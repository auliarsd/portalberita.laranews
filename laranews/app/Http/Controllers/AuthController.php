<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return redirect('/dashboard');
        }
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);


        if (Auth::attempt($credentials)) {
            if (auth()->user()->role == 2) {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            } else if (auth()->user()->role == 1) {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard/berita');
            }
        }


        return redirect()->back()->with('error', 'Username atau Password Salah!');
    }


    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
