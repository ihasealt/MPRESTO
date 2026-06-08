<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('auth.login', [
            'title' => 'Masuk ke PRESTO',
        ]);
    }

    public function attemptLogin(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'identifier' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'identifier.required' => 'Email/NIM wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $role = str_contains(strtolower($validated['identifier']), 'himatris') ? 'admin' : 'mahasiswa';

        session([
            'is_logged_in' => true,
            'user_role' => $role,
            'user_name' => $role === 'admin' ? 'Admin HIMATRIS' : 'Mahasiswa PRESTO',
            'user_identifier' => $validated['identifier'],
        ]);

        return redirect()->route('laporan');
    }

    public function register(): View
    {
        return view('auth.register', [
            'title' => 'Daftar Akun',
        ]);
    }

    public function storeRegister(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'identifier' => ['required', 'string', 'max:40'],
            'email' => ['required', 'email', 'max:120'],
            'password' => ['required', 'string', 'confirmed'],
        ], [
            'name.required' => 'Nama mahasiswa wajib diisi.',
            'identifier.required' => 'Nomor induk mahasiswa wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email belum valid.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.confirmed' => 'Konfirmasi kata sandi belum sama.',
        ]);

        session([
            'is_logged_in' => true,
            'user_role' => 'mahasiswa',
            'user_name' => $validated['name'],
            'user_identifier' => $validated['identifier'],
        ]);

        return redirect()->route('laporan')->with('success', 'Akun berhasil dibuat. Selamat datang di PRESTO.');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->flush();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
