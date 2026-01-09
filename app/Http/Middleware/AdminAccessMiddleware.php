<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware untuk membatasi akses ke area admin
 * Hanya user yang sudah login sebagai admin yang dapat mengakses
 * 
 * @author Rafi Fathan Gandari
 * @nim C2383207002
 * @class PTI 5A
 */
class AdminAccessMiddleware
{
    /**
     * Handle incoming request
     * Cek apakah session admin sudah ada
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah session admin authenticated ada
        if (!session()->has('admin_authenticated') || !session('admin_authenticated')) {
            // Redirect ke halaman login dengan pesan error
            return redirect()
                ->route('admin.login')
                ->withErrors(['access' => 'Anda harus login terlebih dahulu untuk mengakses halaman ini.'])
                ->with('intended_url', $request->url());
        }

        // Opsional: Cek timeout session (contoh: 2 jam)
        $loginTime = session('admin_login_time');
        if ($loginTime) {
            $hoursSinceLogin = now()->diffInHours($loginTime);
            
            // Jika sudah lebih dari 2 jam, logout otomatis
            if ($hoursSinceLogin > 2) {
                session()->forget(['admin_authenticated', 'admin_username', 'admin_login_time']);
                
                return redirect()
                    ->route('admin.login')
                    ->withErrors(['session' => 'Session Anda telah berakhir. Silakan login kembali.']);
            }
        }

        // Jika validasi berhasil, lanjutkan request
        return $next($request);
    }
}