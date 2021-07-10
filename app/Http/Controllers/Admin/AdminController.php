<?php

namespace App\Http\Controllers\admin;

use App\Admin;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\AdminPasswordRequest;
use App\Http\Requests\admin\UpdateProfileRequest;
use App\Http\Requests\AdminLogin;
use App\Sponsor;
use App\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {


        //TIME NOW
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        //WIGRED
        $employees = DB::table('employees')->count();
        $volunteers = DB::table('volunteers')->count();
        $news = DB::table('news')->count();
        $events = DB::table('event')->count();

        //CHART EVENT
        $tinhnguyen = DB::table('news')->where('type', 'Volunteering')->count();
        $tochuc = DB::table('news')->where('type', 'Organisations')->count();
        $blog = DB::table('news')->where('type', 'Our Blog')->count();
        $chart1 = (new LarapexChart)->pieChart()
            ->addData([$tinhnguyen, $tochuc, $blog])
            ->setLabels(['Tình nguyện', 'Tổ chức', 'Blog']);
        //CHART EVENT
        $moitruong = DB::table('event')->where('type', 'Môi trường')
            ->where('status', 1)
            ->count();
        $thethao = DB::table('event')->where('type', 'Thể thao')
            ->where('status', 1)
            ->count();
        $quyentang = DB::table('event')->where('type', 'Quyên tặng')
            ->where('status', 1)
            ->count();
        $chart2 = (new LarapexChart)->donutChart()
            ->addData([$moitruong, $thethao, $quyentang])
            ->setLabels(['Môi trường', 'Thể thao', 'Quyên tặng']);
        //TIMELINE
        $upcomming_event = DB::table('event')
            ->orderBy('start_day', 'asc')
            ->where('start_day', '>', $now)
            ->take(5)->get();
        //LINE CHART
        $monthnow = DB::table('event')
            ->whereMonth('start_day', now()->month)
            ->count();
        $monthcurrent = DB::table('event')
            ->whereMonth('start_day', now()->subMonth()->month)
            ->count();
        $monthcurrent2 = DB::table('event')
            ->whereMonth('start_day', now()->subMonths(2)->month)
            ->count();

        $chart3 = (new LarapexChart)->lineChart()
            ->setTitle('Tổng sự kiện trong tháng')
            ->setSubtitle($now)
            ->addData('Sự kiện', [$monthnow, $monthcurrent, $monthcurrent2])
            ->setXAxis(['Tháng này', 'Tháng trước', '2 Tháng trước']);

        return view('admin.pages.dashboard', compact('chart1', 'chart2', 'chart3', 'employees', 'volunteers', 'events', 'news', 'upcomming_event', 'now'));
    }

    public function showlogin()
    {
        if (session()->exists('login-admin')) {
            return redirect()->route('dashboard');
        }
        return view('admin.pages.login');
    }

    public function login(AdminLogin $request)
    {
        $user = User::where('email', $request->get('email'))->first();
        if ($user) {
            $admin = Admin::where('user_id', $user->id)->first();
            $employee = Employee::where('user_id', $user->id)->first();
            $sponsor = Sponsor::where('user_id', $user->id)->first();
            if ($admin || $employee || $sponsor) {
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    session()->put('login-admin', $user->email);
                    toastr()->success('đăng nhập thành công!', 'Thông báo', ['timeOut' => 2000]);
                    return redirect()->route('dashboard');
                }
                session()->flash('error', 'Mật khẩu sai!');
                return back()->withInput();
            }
            session()->flash('error', 'Bạn không có quyền!');
            return back()->withInput();
        }
        session()->flash('error', 'Email không tồn tại!');
        return back()->withInput();
    }

    public function logout()
    {
        Auth::logout();
        session()->forget('login-admin');
        toastr()->success('Đăng xuất thành công!', 'Thông báo', ['timeOut' => 2000]);
        return redirect()->route('login.show');
    }

    public function profile()
    {

        $user = User::query()
            ->where('id', Auth::user()->id)
            ->first();
        $employee = Employee::query()->where('user_id', Auth::user()->id)->first();
        $admin = Admin::query()->where('user_id', Auth::user()->id)->first();
        // dd($employee);
        return view('admin.pages.profile', compact('user', 'employee', 'admin'));
    }

    public function showpassword()
    {
        $user = User::query()
            ->where('id', Auth::user()->id)
            ->first();
        $employee = Employee::query()->where('user_id', Auth::user()->id)->first();
        $admin = Admin::query()->where('user_id', Auth::user()->id)->first();
        return view("admin.pages.changepassword", compact('user', 'employee', 'admin'));
    }

    public function UpdateAdmin(UpdateProfileRequest $request)
    {
        $result = DB::transaction(function () use ($request) {
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            // $user['password'] = bcrypt($request->password);
            if ($user->save()) {
                $admin = Admin::query()
                    ->where('user_id', $request->id)
                    ->first();
                $admin->gender = $request->gender;
                $admin['birthday'] = date("Y-m-d ", strtotime($request->birthday));
                $admin->phone = $request->phone;
                $admin->address = $request->address;
                $admin->save();
            }
        });
        if (!$result) {
            toastr()->success('Cập nhật thông tin thành công!', 'Thông báo', ['timeOut' => 2000]);
        } else {
            toastr()->error('Lỗi!');
            return back();
        }
        return redirect()->route('admin.profile');
    }

    public function UpdateEmployee(UpdateProfileRequest $request)
    {
        $result = DB::transaction(function () use ($request) {
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            // $user['password'] = bcrypt($request->password);
            if ($user->save()) {
                $employee = Employee::query()
                    ->where('user_id', $request->id)
                    ->first();
                $employee->gender = $request->gender;
                $employee['birthday'] = date("Y-m-d ", strtotime($request->birthday));
                $employee->phone = $request->phone;
                $employee->address = $request->address;
                $employee->save();
            }
        });
        if (!$result) {
            toastr()->success('Cập nhật thông tin thành công!', 'Thông báo', ['timeOut' => 2000]);
        } else {
            toastr()->error('Lỗi!');
            return redirect()->route('admin.profile');
        }
        return redirect()->route('admin.profile');
    }

    public function updatePassword(AdminPasswordRequest $request)
    {

        $id = Auth::user()->id;
        $user = User::find($id);
        if ($user !== null) {
            if (Hash::check($request->password_old, $user->password)) {
                $user->password = Hash::make($request->password);
                // $status =  $user->save();
                if ($user->save()) {
                    toastr()->info('Thay đổi mật khẩu thành công!', 'Thông báo', ["positionClass" => "toast-top-right", 'timeOut' => 2000]);
                    return redirect()->route('admin.profile');
                } else {
                    toastr()->error('Lỗi!!!', 'Thông báo', ["positionClass" => "toast-top-right", 'timeOut' => 2000]);
                    return back();
                }
            } else {
                toastr()->error('Mật khẩu cũ sai!!!', 'Thông báo', ["positionClass" => "toast-top-right", 'timeOut' => 2000]);
                return back();
            }
        } else {
            toastr()->error('Không có người dùng này!!!', 'Thông báo', ["positionClass" => "toast-top-right", 'timeOut' => 2000]);
            return back();
        }
    }

    public function markAllNotification(Request $request)
    {
        auth()->user()
            ->unreadNotifications
            ->markAsRead();
        return redirect()->back();
    }

    public function markNotification(Request $request, $id)
    {
        auth()->user()
            ->unreadNotifications
            ->when($id, function ($query) use ($id) {
                return $query->where('id', $id);
            })
            ->markAsRead();

        return redirect()->back();
    }
}
