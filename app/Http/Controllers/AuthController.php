<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password harus diisi.',
            'password.string' => 'Format password tidak valid.',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            sweetalert()->info('Selamat datang '.Auth::user()->name.'!');

            return redirect()->intended('/dashboard');
        } else {
            sweetalert()->error('Login Gagal! Email atau Password Salah!');

            return redirect('/login')->onlyInput('email');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        sweetalert()->success('Anda telah logout.');

        return redirect('/login');
    }
}
