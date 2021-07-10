<?php

namespace App\Http\Middleware;

use App\Permission;
use Closure;
use Illuminate\Support\Facades\DB;
class CheckPermissionACL
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null)
    {
        //lay tat ca cac quyen khi user login vao he thong
            //1. lay tat cac cac role
            $listRoleOfUser = DB::table('users')
            ->join('role_user', 'users.id','=' , 'role_user.user_id')
            ->join('roles', 'role_user.role_id' , '=' , 'roles.id')
            ->where('users.id', auth()->id())
            ->select('roles.*')
            ->get()->pluck('id')->toArray();
            //lay tat ca cac quyen khi user login vao he thong
            $listRoleOfUser = DB::table('roles')
            ->join('permission_role', 'roles.id','=' , 'permission_role.role_id')
            ->join('permissions', 'permission_role.permission_id' , '=' , 'permissions.id')
            ->whereIn('roles.id', $listRoleOfUser)
            ->select('permissions.*')
            ->get()->pluck('id')->unique();

            //lay ra ma man hinh tuong ung de check phan quyen
            $checkPermission = Permission::where('name', $permission)->value('id');
            if($listRoleOfUser->contains($checkPermission)) {
                return $next($request);
            };
            toastr()->error('Bạn không được phép thực hiện hành động này!', 'Thông báo', ['timeOut' => 2000]);
            return back();
            // return abort(401);

    }
}
