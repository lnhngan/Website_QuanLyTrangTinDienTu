<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // BƯỚC 1: KIỂM TRA ĐĂNG NHẬP
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // BƯỚC 2: LẤY ROLE DƯỚI DẠNG SỐ
        $userRole = (int) $user->role;

        // BƯỚC 3: KIỂM TRA ROLE CÓ TRONG DANH SÁCH CHO PHÉP KHÔNG
        if (!in_array($userRole, array_map('intval', $roles))) {
            // === CHUYỂN PHẦN NÀY VÀO TRONG HÀM ===
            if ($userRole === 1) {
                return redirect()->route('admin.dashboard');
            } elseif ($userRole === 2) {
                return redirect()->route('author.articles.index');
            } else {
                return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập khu vực này.');
            }
        }

        return $next($request);
    }
}