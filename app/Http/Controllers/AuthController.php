<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }

    // Controller Register (Uncomment jika ingin menggunakan register)
    // public function showRegisterForm()
    // {
    //     return view('auth.register');
    // }

    // public function register(Request $request)
    // {
    //     $validated = $request->validate([
    //         'nama' => 'required|string|max:20',
    //         'alamat' => 'required|string|max:50',
    //         'username' => 'required|string|max:20|unique:admins',
    //         'password' => 'required|string|min:6|confirmed',
    //     ]);

    //     $admin = Admin::create([
    //         'nama' => $validated['nama'],
    //         'alamat' => $validated['alamat'],
    //         'username' => $validated['username'],
    //         'password' => Hash::make($validated['password']),
    //     ]);

    //     Auth::guard('admin')->login($admin);
        
    //     return redirect()->route('dashboard');
    // }
}
