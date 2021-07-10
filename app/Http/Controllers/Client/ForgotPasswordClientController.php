<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\client\ForgotPasswordValidate;
use App\Http\Requests\client\ResetPasswordValidate;
use App\PasswordReset;
use App\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordClientController extends Controller
{
    const VALID_TOKEN = 60; // 60 minutes
    public function getEmail()
    {
        return view('main.pages.auth.mailreset');
    }

    public function postEmail(ForgotPasswordValidate $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            $token = Str::random(6);

            $passwordReset = PasswordReset::updateOrCreate(
                [
                    'email' => $user->email,
                ],
                [
                    'token' => $token,
                ]
            );

            if ($passwordReset) {
                Mail::send('main.pages.auth.resetpassword', ['token' => $token, 'username' => $user->name], function ($message) use ($request) {
                    $message->from('tinhnguyenduytan@gmail.com', 'tinhnguyenduytan');
                    $message->to($request->email);
                    $message->replyTo('tinhnguyenduytan@gmail.com', 'tinhnguyenduytan');
                    $message->subject('Đặt lại mật khẩu');
                });

                toastr()->success('Gửi email thành công!', 'Thông báo', ['timeOut' => 2000]);
                return back();
            }
        } catch (Exception $exception) {
            // return $exception;
            toastr()->error('Không tồn tại email!', 'Thông báo', ['timeOut' => 2000]);
            return back();
        }
    }

    public function getPassword($token)
    {
        return view('main.pages.auth.verifypassword', ['token' => $token]);
    }

    public function resetPassword(ResetPasswordValidate $request)
    {
        $passwordReset = PasswordReset::where('token', $request->token)->first();

        if (!$passwordReset) {
            return back()->with('message', 'Token không hợp lệ');
        }

        if (Carbon::parse($passwordReset->updated_at)->addMinutes(self::VALID_TOKEN)->isPast()) {
            $passwordReset->delete();
            return back()->with('message', 'Token không hợp lệ');
        }

        $user = User::where('email', $passwordReset->email)->firstOrFail();
        $user->update(['password' => Hash::make($request->password)]);
        $passwordReset->delete();

        toastr()->success('Cập nhật mật khẩu thành công!', 'Thông báo', ['timeOut' => 2000]);
        return redirect()->route('client.getLogin');
    }
}
