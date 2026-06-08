<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    public function dashboard(): View
    {
        return view('pages.dashboard', [
            'title' => 'Dashboard',
            'active' => 'dashboard',
        ]);
    }

    public function laporan(): View
    {
        return view('pages.laporan', [
            'title' => 'Laporan',
            'active' => 'laporan',
            'role' => session('user_role', 'mahasiswa'),
            'name' => session('user_name', 'Mahasiswa PRESTO'),
        ]);
    }

    public function arsip(): View
    {
        return view('pages.placeholder', [
            'title' => 'Arsip Prestasi',
            'active' => 'arsip',
            'heading' => 'Arsip Prestasi',
            'copy' => 'Halaman arsip prestasi akan menampilkan riwayat prestasi yang sudah diverifikasi.',
        ]);
    }

    public function hallOfFame(): View
    {
        return view('pages.placeholder', [
            'title' => 'Hall of Fame',
            'active' => 'hall',
            'heading' => 'Hall of Fame',
            'copy' => 'Halaman apresiasi untuk mahasiswa berprestasi HIMATRIS.',
        ]);
    }
}
