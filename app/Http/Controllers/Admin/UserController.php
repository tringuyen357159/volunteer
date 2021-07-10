<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index()
    {
        // $users= User::all();
        $users = DB::table('users')
            ->join('employees', 'users.id', '=', 'employees.user_id')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('employees.*', 'users.*', 'roles.display_name')
            ->orderBy('users.id','desc')
            ->get();
        return view('admin.pages.user.index', compact('users'));
    }

    public function edit($id)
    {
        $roles = Role::all();
        $user = User::find($id);
        $listRoleOfUser = DB::table('role_user')->where('user_id', $id)->pluck('role_id');
        return view('admin.pages.user.edit', compact('roles', 'user', 'listRoleOfUser'));
    }

    public function update($id, UserUpdateRequest $request)
    {
        DB::table('role_user')->where('user_id', $id)->delete();
        $user = User::find($id);

        $current_day = DB::table('historyrole')->where('user_id', $id)->select('from_day')->first();
        // dd($current_day->from_day);

        $roles = $request->roles;
        foreach ($roles as $roleId) {
            DB::table('role_user')->insert([
                'user_id' => $user->id,
                'role_id' => $roleId,
            ]);

            $historyrole = DB::table('historyrole')
                ->where('user_id', '=', $user->id)
                ->where('role_id', '=', $roleId)
                ->first();

            if ($historyrole == null) {
                DB::table('historyrole')->insert([
                    'user_id' => $user->id,
                    'role_id' => $roleId,
                    'from_day' => $current_day->from_day,
                    'today' => Carbon::now()->toDateString(),
                ]);
            }

        }

        toastr()->success('Cập nhật thành công!', 'Thông báo', ['timeOut' => 2000]);
        return redirect()->route('user.index');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->employees()->delete();
        // $user->delete();
        $user->roles()->detach();
        toastr()->success('Xoá thành công!', 'Thông báo', ['timeOut' => 2000]);
        return redirect()->route('user.index');
    }
}
