<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'kode' => 'required|exists:m_pegawai,kode',
        ], [
            'kode.required' => 'Kode pegawai harus diisi',
            'kode.exists' => 'Kode pegawai tidak ditemukan'
        ]);
        // dd('berhasil');
        $pegawai = Pegawai::where('kode', $request->kode)->first();

        if (Auth::loginUsingId($pegawai->id)) {
            $request->session()->regenerate();

            return redirect()->intended('/crud');
        }

        return back()->with('loginError', 'Login gagal, silahkan masukkan email dan password dengan benar');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
