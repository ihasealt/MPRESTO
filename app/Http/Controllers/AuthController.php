<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

        $identifier = trim($validated['identifier']);

        // Cari user berdasarkan email atau NIM
        $user = User::where('email', $identifier)
            ->orWhere('nim', $identifier)
            ->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            return back()
                ->withInput($request->only('identifier'))
                ->withErrors(['identifier' => 'Email/NIM atau kata sandi tidak valid.']);
        }

        Auth::login($user);

        // Set session pendukung untuk keselarasan tampilan
        session([
            'is_logged_in' => true,
            'user_id' => $user->id,
            'user_role' => $user->role,
            'user_name' => $user->name,
            'user_identifier' => $user->nim ?: $user->email,
            'user_email' => $user->email,
            'user_prodi' => $user->prodi ?? 'Sistem Informasi',
        ]);

        return redirect()->route('laporan')->with('success', 'Selamat datang kembali, ' . $user->name . '!');
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
            'identifier' => ['required', 'string', 'max:40', 'unique:users,nim'],
            'email' => ['required', 'email', 'max:120', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', 'min:4'],
        ], [
            'name.required' => 'Nama mahasiswa wajib diisi.',
            'identifier.required' => 'Nomor induk mahasiswa (NIM) wajib diisi.',
            'identifier.unique' => 'NIM ini sudah terdaftar di database.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email belum valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.confirmed' => 'Konfirmasi kata sandi belum sama.',
            'password.min' => 'Kata sandi minimal 4 karakter.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'nim' => $validated['identifier'],
            'email' => $validated['email'],
            'role' => 'mahasiswa',
            'prodi' => 'Sistem Informasi',
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        session([
            'is_logged_in' => true,
            'user_id' => $user->id,
            'user_role' => $user->role,
            'user_name' => $user->name,
            'user_identifier' => $user->nim,
            'user_email' => $user->email,
            'user_prodi' => $user->prodi,
        ]);

        return redirect()->route('laporan')->with('success', 'Akun berhasil dibuat. Selamat datang di PRESTO!');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
