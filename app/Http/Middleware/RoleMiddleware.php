<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (! Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        $redirectUrl = route('dashboard');

        $message = 'Anda tidak memiliki hak akses ke halaman ini. Mengalihkan kembali ke dashboard Anda dalam 3 detik...';

        // Kembalikan view kustom dengan status 403 (Forbidden)
        return response()->view('errors.role_denied', [
            'message' => $message,
            'redirectUrl' => $redirectUrl,
        ], 403);
    }
}
