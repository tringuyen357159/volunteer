<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleAdd;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.pages.role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.pages.role.add', compact('permissions'));
    }

    public function store(RoleAdd $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $role = Role::create($data);

            $role->permissions()->attach($request->permission);

            DB::commit();
            toastr()->success('Tạo thành công!', 'Thông báo', ['timeOut' => 2000]);
            return redirect()->route('role.index');

        } catch (\Exception $exception) {
            DB::rollBack();
        }

    }

    public function edit($id)
    {
        $permissions = Permission::all();
        $role = Role::find($id);
        $allPermiss = DB::table('permission_role')->where('role_id', $id)->pluck('permission_id');
        return view('admin.pages.role.edit', compact('permissions', 'role', 'allPermiss'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $role = Role::find($id)->update($data);

            DB::table('permission_role')->where('role_id', $id)->delete();
            $role = Role::find($id);
            $role->permissions()->attach($request->permission);

            DB::commit();
            toastr()->success('Sửa thành công!', 'Thông báo', ['timeOut' => 2000]);
            return redirect()->route('role.index');
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $role = Role::find($id);
            $role->delete();

            $role->permissions()->detach();
            DB::commit();
            toastr()->success('Xoá thành công!', 'Thông báo', ['timeOut' => 2000]);
            return redirect()->route('role.index');
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }
}
