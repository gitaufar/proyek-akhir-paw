<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role' => 'user',
        ]);

        return redirect('/')->with('success', 'Akun berhasil dibuat!');
    }
    public function showRegisterForm()
    {
        return view('welcome'); // sesuaikan dengan file blade kamu
    }
    public function showLoginForm()
    {
        return view('login'); // Tampilkan form login
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->intended('/admin/modul');
            } else {
                return redirect()->intended('/list_modul');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
