<?php

namespace App\Http\Middleware;

use Closure;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->session()->exists('login-admin')) {
            toastr()->error('Bạn phải đăng nhập trước!', 'Thông báo', ['timeOut' => 5000]);
            return back();
        }
        return $next($request);
    }
}
