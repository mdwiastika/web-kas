<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login', [
            'title' => 'Form Login',
            'active' => '',
            'act' => '',
        ]);
    }
    public function checkLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user->status == 'Non Aktif') {
            return back()->with('status', 'error')->with('message', 'Akun masih dinonaktifkan');
        }
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('status', 'success')->with('message', 'berhasil login');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('status', 'success')->with('message', 'berhasil logout');
    }
}
