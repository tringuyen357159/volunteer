<?php

namespace App\Http\Middleware;

use Closure;

class VolunteerMiddleware
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

        if (!$request->session()->exists('user')) {
            toastr()->warning('Vui lòng đăng nhập trước!', 'Thông báo', ["positionClass" => "toast-top-right",'timeOut' => 5000]);
            return redirect()->route('client.getLogin');
        }
        return $next($request);
    }
}
