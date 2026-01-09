<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * AdminPanelController - Mengelola authentication dan dashboard admin
 * 
 * @author Rafi Fathan Gandari
 * @nim C2383207002
 * @class PTI 5A
 */
class AdminPanelController extends Controller
{
    /**
     * Tampilkan halaman login admin
     * 
     * @return \Illuminate\View\View
     */
    public function showLogin()
    {
        // Redirect ke dashboard jika sudah login
        if (session()->has('admin_authenticated')) {
            return redirect()->route('admin.panel');
        }

        return view('admin.login');
    }

    /**
     * Proses login admin
     * Menggunakan session-based authentication sederhana
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        // Kredensial admin (hardcoded untuk UAS)
        // Dalam production, gunakan User model dengan bcrypt
        $adminCredentials = [
            'username' => 'rafi_admin',
            'password' => 'RafiBlog2026!'
        ];

        // Cek kredensial
        if ($request->username === $adminCredentials['username'] && 
            $request->password === $adminCredentials['password']) {
            
            // Set session admin
            session([
                'admin_authenticated' => true,
                'admin_username' => $adminCredentials['username'],
                'admin_login_time' => now()
            ]);

            return redirect()
                ->route('admin.panel')
                ->with('success', 'Selamat datang di NexaBlog Admin Panel!');
        }

        // Login gagal
        return back()
            ->withErrors(['login' => 'Username atau password salah'])
            ->withInput($request->only('username'));
    }

    /**
     * Dashboard admin dengan statistik
     * 
     * @return \Illuminate\View\View
     */
    public function panel()
    {
        // Statistik publikasi
        $stats = [
            'total_publications' => Publication::count(),
            'published' => Publication::where('publication_status', 'publish')->count(),
            'drafts' => Publication::where('publication_status', 'draft')->count(),
            'total_views' => Publication::sum('view_count')
        ];

        // 5 artikel terbaru (semua status)
        $recentPublications = Publication::latest()
            ->limit(5)
            ->get();

        // 5 artikel paling populer (berdasarkan view)
        $popularPublications = Publication::published()
            ->orderBy('view_count', 'desc')
            ->limit(5)
            ->get();

        return view('admin.panel', compact('stats', 'recentPublications', 'popularPublications'));
    }

    /**
     * Logout admin
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        // Hapus session admin
        session()->forget(['admin_authenticated', 'admin_username', 'admin_login_time']);
        session()->flush();

        return redirect()
            ->route('admin.login')
            ->with('success', 'Anda telah logout');
    }
}