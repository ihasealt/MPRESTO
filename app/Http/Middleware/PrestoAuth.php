<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PrestoAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->get('is_logged_in')) {
            return redirect()
                ->route('login')
                ->with('error', 'Silakan login terlebih dahulu untuk mengakses Laporan.');
        }

        return $next($request);
    }
}
