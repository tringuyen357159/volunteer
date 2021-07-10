<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\User;

class SetActiveUser
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
        if (isset($user->active_at) && $user->active_at > Carbon::now('Asia/Ho_Chi_Minh')) {
            Session::forget('user');
            toastr()->warning('Tài khoản đã bị khoá!', 'Thông báo', ["positionClass" => "toast-top-right",'timeOut' => 5000]);
            return redirect()->back();
        }
        return $next($request);
    }
}
