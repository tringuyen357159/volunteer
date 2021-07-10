<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\Volunteer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VolunteerController extends Controller
{
    public function index()
    {
        $employee = Employee::all();
        $volunteers = Volunteer::with('user')->orderBy('id','desc')->get();
        $volunteers = $this->handleVolunteerIsShow($volunteers, $employee);
        // dd($volunteers);
        return view('admin.pages.volunteer.list', compact('volunteers', 'employee'));

    }

    public function active(Request $request)
    {
        $day = $request->day ? $request->day : 0;
        $hours = $request->hours ? $request->hours : 0;
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        $dt->addDays($day);
        $dt->addHours($hours);

        $user = User::find($request->id);
        $user->active_at = $dt;
        if ($user->save()) {
            toastr()->success('Khoá thành công!', 'Thông báo', ['timeOut' => 2000]);
            return redirect()->back();
        }
    }

    public function openactive($id)
    {
        $user = User::find($id);
        $user->active_at = null;
        if ($user->save()) {
            toastr()->success('Huỷ khoá thành công!', 'Thông báo', ['timeOut' => 2000]);
            return redirect()->back();
        }
    }

    public function updatevolunteer(Request $request)
    {
        $employee = new Employee();
        $employee->gender = $request->gender;
        $employee->birthday = $request->birthday;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->user_id = $request->user_id;
        $status = $employee->save();
        $roles = $request->roles;
        foreach ($roles as $roleId) {
            DB::table('role_user')->insert([
                'user_id' => $employee->user_id,
                'role_id' => $roleId,
            ]);
            DB::table('historyrole')->insert([
                'user_id' => $employee->user_id,
                'role_id' => $roleId,
                'from_day' => Carbon::now()->toDateString(),
            ]);
        }
        DB::commit();
        toastr()->success('Chỉ định tình nguyện viên thành nhân viên thành công !', 'Thông báo', ['timeOut' => 2000]);
        return redirect()->route('volunteer.show');
    }

    public function show_role($id)
    {
        $roles = Role::all();
        $volunteer = Volunteer::query()->where('user_id', $id)->first();
        return view('admin.pages.volunteer.edit', compact('volunteer', 'roles'));
    }

    public function handleVolunteerIsShow($volunteers, $employees)
    {
        $isShow = true;
        foreach ($volunteers as $volunteer) {
            foreach ($employees as $employee) {
                if ($volunteer->user_id == $employee->user_id) {
                    $isShow = false;
                }
            }
            $volunteer->isShow = $isShow;
            $isShow = true;
        }
        return $volunteers;
    }
}
