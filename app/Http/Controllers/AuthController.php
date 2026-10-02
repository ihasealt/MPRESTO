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
            'identifier.required' => 'Email atau NIM Mahasiswa wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $idLower = strtolower($validated['identifier']);
        $role = (str_contains($idLower, 'himatris') || str_contains($idLower, 'admin')) ? 'admin' : 'mahasiswa';

        $userName = $role === 'admin' ? 'Admin HIMATRIS' : 'Nadya Adella Putri';
        $userIdentifier = $validated['identifier'];

        // If user entered NIM 240102054 or anything similar
        if (str_contains($idLower, 'nadya') || $idLower === '240102054') {
            $userName = 'Nadya Adella Putri';
            $userIdentifier = '240102054';
        }

        session([
            'is_logged_in' => true,
            'user_role' => $role,
            'user_name' => $userName,
            'user_identifier' => $userIdentifier,
        ]);

        return redirect()->route('laporan');
    }

    public function register(): View
    {
        return view('auth.register', [
            'title' => 'Daftar Akun PRESTO',
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
            'user_email' => $validated['email'],
        ]);

        return redirect()->route('laporan')->with('success', 'Akun berhasil dibuat. Selamat datang di PRESTO!');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->flush();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
