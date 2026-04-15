<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{

    public function register()
    {
        return view('manual-auth.registeradmin');
    }

    public function registerProses(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:admin,username|max:50',
            'password' => 'required|min:5',
        ]);

        Admin::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.login')->with('success', 'Akun admin berhasil dibuat!');
    }

    public function index()
    {
        return view('manual-auth.loginadmin');
    }

    public function loginProses(Request $request)
    {
        $admin = $request->validate([
            'username' => 'required|string|max:50',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::guard('admin')->attempt($admin)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')
                ->with('success', 'Login berhasil sebagai Admin!');
        }

        return back()->withErrors([
            'login' => 'Username atau Password salah!',
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
