<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddRequest;
use App\Role;
use App\User;
use App\Volunteer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employee = Employee::with('user')->orderBy('id','desc')->get();
        return view('admin.pages.employee.list', compact('employee'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.pages.employee.add', compact('roles'));
    }

    public function store(UserAddRequest $request)
    {
        try {
            $data = $request->all();
            $data['password'] = Hash::make($request->password);
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                if ($image->isValid()) {
                    $fileName = time() . "_" . rand(0, 9999999) . "." . $image->getClientOriginalExtension();
                    $image->move(public_path('photo/user'), $fileName);
                    $data['photo'] = $fileName;
                }
            }
            $user = User::create($data);

            $data['user_id'] = $user->id;
            $employee = Employee::create($data);
            $volunteer = Volunteer::create($data);
            $roles = $request->roles;
            foreach ($roles as $roleId) {
                DB::table('role_user')->insert([
                    'user_id' => $user->id,
                    'role_id' => $roleId,
                ]);
                DB::table('historyrole')->insert([
                    'user_id' => $user->id,
                    'role_id' => $roleId,
                    'from_day' => Carbon::now()->toDateString(),
                ]);
            }
            DB::commit();
            toastr()->success('Tạo thành công!', 'Thông báo', ['timeOut' => 2000]);
            return redirect()->route('employee.list');

        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->employees()->delete();
        $status = $user->roles()->detach();
        if ($status) {
            toastr()->success('Xoá nhân viên thành công!', 'Thông báo', ['timeOut' => 2000]);
        } else {
            toastr()->error('Xoá nhân viên thất bại!');
        }
        return redirect()->route('employee.list');
    }


}
