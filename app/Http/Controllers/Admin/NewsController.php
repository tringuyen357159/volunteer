<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\NewsStoreRequest;
use App\Http\Requests\admin\NewsUpdateRequest;
use App\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('id', 'DESC')->get();

        return view('admin.pages.news.list')->with('news', $news);
    }

    public function create()
    {
        return view('admin.pages.news.add');
    }

    public function store(NewsStoreRequest $request)
    {
        $data = $request->all();
        $slug = Str::slug($request->title);
        $data['slug'] = $slug;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            if ($image->isValid()) {
                $fileName = time() . "_" . rand(0, 9999999) . "." . $image->getClientOriginalExtension();
                $image->move(public_path('admin/photo/news'), $fileName);
                $data['photo'] = $fileName;
            }
        }
        $user = Auth::user()->id;
        $data['user_id'] = $user;
        $status = News::create($data);
        //dd($status);
        if ($status) {
            toastr()->success('Thêm tin tức thành công!', 'Thông báo', ['timeOut' => 2000]);
        } else {
            toastr()->error('Lỗi');
            return back();
        }
        return redirect()->route('news.show');
    }

    public function edit($id)
    {
        $news = News::find($id);
        return view('admin.pages.news.edit')->with('news', $news);
    }

    public function update(NewsUpdateRequest $request)
    {
        $news = News::find($request->id);
        $data = $request->all();
        $slug = Str::slug($request->title);
        $data['slug'] = $slug;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            if ($image->isValid()) {
                unlink(public_path('admin/photo/news/' . $news->photo));
                $fileName = time() . "_" . rand(0, 9999999) . "." . $image->getClientOriginalExtension();
                $image->move(public_path('admin/photo/news'), $fileName);
                $data['photo'] = $fileName;
            }
        }
        $status = $news->update($data);
        // dd($status);
        if ($status) {
            toastr()->info('Tin tức đã được cập nhật!', 'Thông báo', ['timeOut' => 2000]);
        } else {
            toastr()->error('Lỗi');
        }
        return redirect()->route('news.show');
    }

    public function delete($id)
    {
        $news = News::find($id);
        unlink(public_path('admin/photo/news/' . $news->photo));
        $status = $news->delete();
        if ($status) {
            toastr()->warning('Xoá tin tức thành công!', 'Thông báo', ['timeOut' => 2000]);
        } else {
            toastr()->error('Lỗi!');
        }
        return redirect()->route('news.show');
    }
}
