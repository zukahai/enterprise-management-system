<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()) {
            return redirect(route('login'))->with('error', 'Bạn cần đăng nhập');
        }

        if (auth()->user()->role->role_name != 'admin') {
            return redirect(route('home'))->with('warning', 'Bạn không có quyền truyền truy cập của admin');
        }
        return $next($request);
    }
}
