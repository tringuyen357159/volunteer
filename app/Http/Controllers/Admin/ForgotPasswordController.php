<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordValidate;
use App\Http\Requests\ResetPasswordValidate;
use App\PasswordReset;
use App\User;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    const VALID_TOKEN = 60; // 60 minutes

    public function getEmail()
    {
        return view('admin.pages.customauth.mailreset');
    }

    public function postEmail(ForgotPasswordValidate $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            $token = Str::random(6);

            $passwordReset = PasswordReset::updateOrCreate([
                'email' => $user->email,
            ], [
                'token' => $token,
            ]);
            if ($passwordReset) {
                Mail::send('admin.pages.customauth.mail', ['token' => $token, 'username' => $user->name], function ($message) use ($request) {
                    $message->from('tinhnguyenduytan@gmail.com', 'tinhnguyenduytan');
                    $message->to($request->email);
                    $message->replyTo('tinhnguyenduytan@gmail.com', 'tinhnguyenduytan');
                    $message->subject('Tạo mới mật khẩu');
                });
                return back()->with('message', 'Chúng tôi đã gửi qua e-mail liên kết đặt lại mật khẩu của bạn!');
            }
        } catch (Exception $exception) {
            return back()->with('message', 'Có gì đó sai!');
        }
    }


    public function getPassword($token)
    {
        return view('admin.pages.customauth.reset', ['token' => $token]);
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

        return redirect()->route('admin.login')->with('message', 'Mật khẩu đã được cập nhật thành công!');
    }
}
