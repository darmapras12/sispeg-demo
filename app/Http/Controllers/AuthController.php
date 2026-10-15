<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\Pegawai;
use Illuminate\Support\Facades\Hash; 

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah!']);
    }

    /**
     * Memproses Login Otomatis untuk Akun Guest Demo
     */
    public function loginDemo(Request $request)
    {
        // 1. Cari atau buat akun Guest Demo
        $guestUser = User::firstOrCreate(
            ['email' => 'guest@demo.com'],
            [
                'name' => 'Guest Demo',
                'password' => Hash::make('guest123'),
            ]
        );

        // 2. BERSIHKAN DATA GUEST: Hapus seluruh data pegawai yang dibuat oleh Guest pada sesi sebelumnya
        Pegawai::where('is_demo', true)
               ->orWhere('is_demo', 1)
               ->delete();

        // 3. Login sebagai Guest
        Auth::login($guestUser);
        $request->session()->regenerate();

        return redirect()->route('dashboard')->with('info', 'Anda berhasil masuk sebagai Guest Demo.');
    }

    public function showForgotForm()
    {
        return view('forgot-password');
    }

    public function updatePasswordLangsung(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5|confirmed',
        ], [
            'email.exists' => 'Email tidak terdaftar!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
            'password.min' => 'Password minimal 5 karakter!'
        ]);

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password); 
        $user->save();

        return redirect()->route('login')->with('success', 'Password Berhasil Diperbarui!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}