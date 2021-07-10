<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\SponsorStoreRequest;
use App\Http\Requests\admin\SponsorUpdateRequest;
use App\Sponsor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SponsorController extends Controller
{
    public function index()
    {
        $users = DB::table('users')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('sponsors')
                    ->whereRaw('sponsors.user_id = users.id');
            })
            ->get();
        $sponsor = Sponsor::orderBy('id','desc')->get();
        return view('admin.pages.sponsor.list', compact('sponsor', 'users'));
    }

    public function create()
    {
        return view('admin.pages.sponsor.add');
    }

    public function store(SponsorStoreRequest $request)
    {
        $data = $request->all();
        $status = Sponsor::create($data);
        if ($status) {
            toastr()->success('Thêm nhà tài trợ thành công!', 'Thông báo', ['timeOut' => 2000]);
        } else {
            toastr()->error('Lỗi');
            return back();
        }
        return redirect()->route('sponsor.list');
    }

    public function edit($id)
    {
        $sponsor = Sponsor::find($id);
        return view('admin.pages.sponsor.edit')->with('sponsor', $sponsor);
    }

    public function update(SponsorUpdateRequest $request)
    {
        $sponsor = Sponsor::find($request->id);
        $data = $request->all();
        $status = $sponsor->update($data);
        if ($status) {
            toastr()->info('Nhà tài trợ đã được cập nhật!', 'Thông báo', ['timeOut' => 2000]);
        } else {
            toastr()->error('Lỗi');
        }
        return redirect()->route('sponsor.list');
    }

    public function delete($id)
    {
        $sponsor = Sponsor::find($id);
        $status = $sponsor->delete();
        if ($status) {
            toastr()->success('Xoá nhà tài trợ thành công!', 'Thông báo', ['timeOut' => 2000]);
        } else {
            toastr()->error('Lỗi!');
        }
        return redirect()->route('sponsor.list');
    }

    public function showmakeuser($id)
    {
        $sponsor = Sponsor::find($id);
        return view('admin.pages.user.user', compact('sponsor'));
    }

    public function makeuser(Request $request, $id)
    {
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

        $sponsor = Sponsor::find($id);
        $data['user_id'] = $user->id;
        $sponsor = $sponsor->update($data);
        if ($user) {
            toastr()->success('Tạo tài khoản cho nhà tài trợ thành công!', 'Thông báo', ['timeOut' => 1000]);
            return redirect()->route('sponsor.list');
        }
        toastr()->error('Lỗi');
        return back();

    }

    public function showdonate(Request $request, $id)
    {
        $sponsor = Sponsor::find($id);
        if ($sponsor) {
            return view('admin.pages.sponsor.donate', compact('sponsor'));
        }
    }

    public function donate(Request $request, $id)
    {
        $sponsor = Sponsor::find($id);

        if ($sponsor) {
            $data = $request->all();
            $data['id'] = $id;
            $data['name'] = $sponsor->name;
            $data['email'] = $sponsor->email;
            $data['phone'] = $sponsor->phone;
            $data['address'] = $sponsor->address;
            $data['user_id'] = $sponsor->user_id;
            $data['anonymous'] = $sponsor->anonymous;
            $data['method'] = $sponsor->method;

            $status = Sponsor::create($data);
            return redirect()->route('sponsor.list');
        }
    }

    public function showmakesponser(Request $request, $id)
    {
        $user = User::find($id);
        $sponsors = Sponsor::all();
        return view('admin.pages.user.sponsor', compact('user'));
    }

    public function makesponser(SponsorStoreRequest $request, $id)
    {
        $data = $request->all();
        $data['user_id'] = $id;
        $status = Sponsor::create($data);
        if ($status) {
            toastr()->success('Tạo nhà tài trợ thành công!', 'Thông báo', ['timeOut' => 1000]);
        } else {
            toastr()->error('Lỗi');
            return back();
        }
        return redirect()->route('sponsor.list');
    }

    public function list()
    {
        $userid = Auth::user()->id;
        if($userid == 8){
            $detail_spending = DB::table('detail_spending')
            ->join('event', 'event.id', '=', 'detail_spending.event_id')
            ->join('sponsors', 'sponsors.id', '=', 'detail_spending.sponsor_id')
            ->select('event.title', 'detail_spending.*', 'sponsors.name')
            ->orderBy('detail_spending.id','desc')
            ->get();
        return view('admin.pages.detail_spending.list', compact('detail_spending'));
        }
        else{
        $detail_spending = DB::table('detail_spending')
            ->join('event', 'event.id', '=', 'detail_spending.event_id')
            ->join('sponsors', 'sponsors.id', '=', 'detail_spending.sponsor_id')
            ->select('event.title', 'detail_spending.*', 'sponsors.name')
            ->where('sponsors.user_id', $userid)
            ->orderBy('detail_spending.id','desc')
            ->get();
        return view('admin.pages.detail_spending.list', compact('detail_spending'));
        }
    }

    public function statistical()
    {
        $sum_amount_financed = Sponsor::query()->sum('amount_financed');
        $sum_amount_spent = Sponsor::query()->sum('amount_spent');
        $sum_remain = $sum_amount_financed - $sum_amount_spent;
        return view('admin.pages. statistical.index', compact('sum_amount_financed','sum_amount_spent','sum_remain'));
    }

}
