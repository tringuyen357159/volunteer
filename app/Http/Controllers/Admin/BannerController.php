<?php

namespace App\Http\Controllers\admin;

use App\Banner;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerAddRequest;
use App\Http\Requests\BannerUpdateRequest;
use App\Notifications\AllNotification;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('id','desc')->get();
        return view('admin.pages.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.pages.banner.add');
    }

    public function store(BannerAddRequest $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->all();
        $data['user_id'] = $user_id;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            if ($image->isValid()) {
                $fileName = time() . "_" . rand(0, 9999999) . "." . $image->getClientOriginalExtension();
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(1800, 900);
                $image_resize->save(public_path('photo/banner/' . $fileName));
                $data['photo'] = $fileName;
            }
        }
        $banner = Banner::create($data);
        toastr()->success('Tạo thành công!', 'Thông báo', ['timeOut' => 2000]);
        return redirect()->route('banner.index');
    }

    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('admin.pages.banner.edit', compact('banner'));
    }

    public function update($id, BannerUpdateRequest $request)
    {
        $banner = Banner::find($id);
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            if ($image->isValid()) {
                unlink(public_path('/photo/banner/' . $banner->photo));
                $fileName = time() . "_" . rand(0, 9999999) . "." . $image->getClientOriginalExtension();
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(1800, 900);
                $image_resize->save(public_path('photo/banner/' . $fileName));
                $data['photo'] = $fileName;
            }
        }
        $banner->update($data);
        toastr()->success('Sửa thành công!', 'Thông báo', ['timeOut' => 2000]);
        return redirect()->route('banner.index');
    }

    public function delete($id)
    {
        $banner = Banner::find($id);
        unlink(public_path('/photo/banner/' . $banner->photo));
        $banner->delete();
        toastr()->success('Xoá thành công!', 'Thông báo', ['timeOut' => 2000]);
        return redirect()->route('banner.index');
    }
}
