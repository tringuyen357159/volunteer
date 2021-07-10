<?php

namespace App\Http\Controllers\Client;

use App\Admin;
use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\client\VolunteerStoreRequest;
use App\Http\Requests\client\VolunteerUpdateRequest;
use App\Http\Requests\client\VolunteerLoginRequest;
use App\Http\Requests\client\VolunteerPasswordRequest;
use App\User;
use App\Volunteer;
use App\event_volunteer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Event;
use App\event_tool;
use App\Notifications\NewVolunteerNotification;
use App\tool_volunteer;
use App\Tools;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class VolunteerController extends Controller
{

    public function showLogin()
    {
        if (session('user') == true) {
            return redirect()->route('home');
        } else
            return view('main.pages.auth.login');
    }

    public function storeLogin(VolunteerLoginRequest $request)
    {
        $user = User::query()
            ->where('email', $request->get('email'))
            ->first();
        if ($user !== null) {
            $volunteer = Volunteer::where('user_id', $user->id)->first();
            $admin = Admin::where('user_id', $user->id)->first();
            $employee = Employee::where('user_id', $user->id)->first();
            if ($volunteer || $admin || $employee) {
                if (Hash::check($request->get('password'), $user->password)) {
                    $request->session()->put('user', $user->email);
                    toastr()->info('Đăng nhập thành công!', 'Thông báo', ["positionClass" => "toast-top-right", 'timeOut' => 5000]);
                    return redirect()->intended();
                } else {
                    toastr()->error('Sai mật khẩu!!!');
                    return back();
                }
            } else {
                toastr()->error('Người dùng không tồn tại!!!!');
                return back();
            }
        } else {
            toastr()->error('Người dùng không tồn tại!!!!');
            return back();
        }
    }

    public function logout()
    {
        session()->forget('user');
        toastr()->success('Đăng xuất thành công!', 'Thông báo', ['timeOut' => 2000]);
        return redirect()->route('client.getLogin');
    }


    public function showRegister()
    {
        return view('main.pages.auth.register');
    }

    public function storeRegister(VolunteerStoreRequest $request)
    {
        $result = DB::transaction(function () use ($request) {
            $user = new User();
            $user->name = $request->name;
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                if ($image->isValid()) {
                    $fileName = time() . "_" . rand(0, 9999999) . "." . $image->getClientOriginalExtension();
                    $image->move(public_path('photo/user'), $fileName);
                    $user->photo = $fileName;
                }
            }
            $user->email = $request->email;
            $user['password'] = bcrypt($request->password);
            if ($user->save()) {
                $user_noty = User::all();
                Notification::send($user_noty, new NewVolunteerNotification($user));

                Mail::send('main.pages.auth.sendmail', ['user' => $user, 'user_id' => $user->id], function ($message) use ($request) {
                    $message->to($request->email);
                    $message->subject('Xác thực tài khoản');
                });

                $userId = User::select()->max('id');
                $volunteer = new Volunteer();
                $volunteer->gender = $request->gender;
                $volunteer['birthday'] = date("Y-m-d ", strtotime($request->birthday));
                $volunteer->phone = $request->phone;
                $volunteer->address = $request->address;
                $volunteer->user_id = $userId;
                $volunteer->save();
            }
        });
        toastr()->info('Đăng ký thành công hãy vào kiểm tra mail trước khi đăng nhập', 'Thông báo', ["positionClass" => "toast-top-right", 'timeOut' => 5000]);
        return redirect()->route('home');
    }

    public function verifyemail($id)
    {
        $user = User::find($id);
        $user->status = 'active';
        $user->save();
        toastr()->info('Xác thực tài khoản thành công', 'Thông báo', ["positionClass" => "toast-top-right", 'timeOut' => 5000]);
        return redirect()->route('home');
    }

    public function showProfile()
    {
        $user = User::query()
            ->where('email', session()->get('user'))
            ->first();
        $volunteer = Volunteer::query()
            ->where('user_id', $user->id)
            ->first();
        return view('main.pages.auth.profile')
            ->with('user', $user)
            ->with('volunteer', $volunteer);
    }

    public function updateProfile(VolunteerUpdateRequest $request)
    {
        $result = DB::transaction(function () use ($request) {
            $user = User::find($request->id);
            $user->name = $request->name;
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                if ($image->isValid()) {
                    $fileName = time() . "_" . rand(0, 9999999) . "." . $image->getClientOriginalExtension();
                    $image->move(public_path('photo/user'), $fileName);
                    $user->photo = $fileName;
                }
            }
            $user->email = $request->email;
            $user['password'] = bcrypt($request->password);
            if ($user->save()) {
                $volunteer = Volunteer::query()
                    ->where('user_id', $request->id)
                    ->first();
                $volunteer->gender = $request->gender;
                $volunteer['birthday'] = date("Y-m-d ", strtotime($request->birthday));
                $volunteer->phone = $request->phone;
                $volunteer->address = $request->address;
                $volunteer->save();
            }
        });
        if (!$result) {
            toastr()->success('Cập nhật thông tin tình nguyện viên thành công!', 'Thông báo', ['timeOut' => 2000]);
        } else {
            toastr()->error('Lỗi!');
            return back();
        }
        return redirect()->route('client.getProfile');
    }
    public function showPassword()
    {
        return view('main.pages.auth.password');
    }


    public function updatePassword(VolunteerPasswordRequest $request)
    {
        $user = User::query()
            ->where('email', session()->get('user'))
            ->first();
        if ($user !== null) {
            if (Hash::check($request->password_old, $user->password)) {
                $user->password = bcrypt($request->password);
                $status =  $user->save();
                if ($status) {
                    toastr()->info('Thay đổi mật khẩu thành công!', 'Thông báo', ["positionClass" => "toast-top-right", 'timeOut' => 5000]);
                    return redirect()->route('client.getProfile');
                } else {
                    toastr()->error('Lỗi!!!');
                    return back();
                }
            } else {
                toastr()->error('Mật khẩu cũ sai!!!');
                return back();
            }
        } else {
            toastr()->error('Không có người dùng này!!!');
            return back();
        }
    }

    public function eventManagement()
    {
        $user = User::query()
            ->where('email', session()->get('user'))
            ->first();
        $event_register = event_volunteer::query()
            ->with('event')
            ->orderBy('id', 'desc')
            ->where('user_id', '=', $user->id)
            ->paginate(6);
        $day = Carbon::now('Asia/Ho_Chi_Minh');
        foreach ($event_register as  $value) {
            $value->toolVolunteer = tool_volunteer::where('event_id', $value->event->id)
                ->where('user_id', '=', $user->id)
                ->get();
        }
        return view('main.pages.event.eventmanager')
            ->with('day', $day)
            ->with('event_register', $event_register);
    }

    public function deleteEvent($eventId, $userId)
    {
        $event_register = event_volunteer::where('event_id', $eventId)
            ->where('user_id', $userId)
            ->first();
        $toolVolunteer = tool_volunteer::where('user_id', $userId)
            ->where('event_id', $eventId)
            ->get();
        $event_detail = Event::query()
            ->where('id', $event_register->event_id)
            ->first();
        $day = Carbon::now('Asia/Ho_Chi_Minh');
        if (strtotime($event_detail->start_day) - strtotime($day) < 86319) {
            toastr()->error('Sự kiện sắp diễn ra nên bạn không thể huỷ sự kiện!!!');
            return redirect()->back();
        } else {
            try {
                DB::beginTransaction();
                foreach ($toolVolunteer as  $value) {
                    $value->delete();
                    $eventTool = event_tool::where('tool_id', $value->tool_id)
                        ->where('event_id', $value->event_id)
                        ->first();
                    $eventTool->update(['real_quanlity' => $eventTool->real_quanlity - $value->quanlity]);
                }
                $event_register->delete();
                DB::commit();
                $event_detail->update(['real_quantity' => $event_detail->real_quantity - 1]);
                toastr()->success('Huỷ sự kiện thành công!', 'Thông báo', ['timeOut' => 2000]);
                return redirect()->route('client.eventmanagement');
            } catch (\Exception $e) {
                DB::rollback();
                toastr()->success('Huỷ sự kiện thất bại!', 'Thông báo', ['timeOut' => 2000]);
                return redirect()->route('client.eventmanagement');
            }
        }
    }
}
