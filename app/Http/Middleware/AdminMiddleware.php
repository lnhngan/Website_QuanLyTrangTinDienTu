<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $userRole = Auth::user()->role; // Bây giờ là số: 1, 2, 3

    foreach ($roles as $role) {
        // So sánh số
        if ($userRole == $role) {
            return $next($request);
        }
    }

    return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập.');
}
}
