<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function index()
    {
        return view('manual-auth.loginadmin');
    }

    public function loginProses(Request $request)
    {
        // Validasi sesuai field tabel admin
        $admin = $request->validate([
            'username' => 'required|string|max:50',
            'password' => 'required|string|min:6',
        ]);

        // Login dengan guard admin
        if (Auth::guard('admin')->attempt($admin)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')
                ->with('success', 'Login berhasil sebagai Admin!');
        }

        return back()->withErrors([
            'login' => 'Username atau Password salah!', // 'login' bikinan sendiri
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')
            ->with('success', 'logout berhasil');
    }
}
