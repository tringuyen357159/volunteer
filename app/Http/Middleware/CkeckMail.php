<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Session;

class CkeckMail
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
        $user = User::where('email', $request->email)->first();
        if ($user->status == "unactive") {
            Session::forget('user');
            toastr()->warning('Vui lòng kiểm tra mail trước!', 'Thông báo', ["positionClass" => "toast-top-right", 'timeOut' => 5000]);
            return redirect()->back();
        }
        return $next($request);
    }
}
