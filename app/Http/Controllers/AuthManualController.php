<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthManualController extends Controller
{
    public function index()
    {
        return view('manual-auth.loginsiswa');
    }

    public function loginProses(Request $request)
    {
        $siswa = $request->validate([
            'nis' => 'required|numeric|digits:10',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt($siswa)) {
            $request->session()->regenerate();
            return redirect()->route('input-aspirasi.index') //ke inputaspirasi sementara aja
                ->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'login' => 'NIS atau Password salah!',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->with('success', 'logout berhasil');
    }
}
