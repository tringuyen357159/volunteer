<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ToolStoreRequest;
use App\Http\Requests\admin\ToolUpdateRequest;
use App\Tools;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tools::orderBy('id','desc')->get();
        return view('admin.pages.tool.list', compact('tools'));
    }

    public function create()
    {
        return view('admin.pages.tool.add');
    }

    public function store(ToolStoreRequest $request)
    {
        $tools = new Tools();
        $tools->name = $request->name;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            if ($image->isValid()) {
                $fileName = time() . "_" . rand(0, 9999999) . "." . $image->getClientOriginalExtension();
                $image->move(public_path('admin/photo/tool'), $fileName);
                $tools->photo = $fileName;
            }
        }
        $status = $tools->save();
        if ($status) {
            toastr()->success('Thêm sự dụng cụ thành công thành công!', 'Thông báo', ['timeOut' => 2000]);
        } else {
            toastr()->error('failed!');
            return back();
        }
        return redirect()->route('tool.list');
    }

    public function edit($id)
    {
        $tools = Tools::find($id);
        return view('admin.pages.tool.edit', compact('tools'));
    }

    public function update(ToolUpdateRequest $request)
    {

        $tools = Tools::find($request->id);
        $tools->name = $request->name;
        if ($request->hasFile('photo')) {
            unlink(public_path('admin/photo/tool/' . $tools->photo));
            $image = $request->file('photo');
            if ($image->isValid()) {
                $fileName = time() . "_" . rand(0, 9999999) . "." . $image->getClientOriginalExtension();
                $image->move(public_path('admin/photo/tool'), $fileName);
                $tools->photo = $fileName;
            }
        }
        $status = $tools->save();
        if ($status) {
            toastr()->success('Sửa sự dụng cụ thành công thành công!', 'Thông báo', ['timeOut' => 2000]);
        } else {
            toastr()->error('failed!');
            return back();
        }
        return redirect()->route('tool.list');
    }

    public function delete($id)
    {
        $tools = Tools::find($id);
        unlink(public_path('admin/photo/tool/' . $tools->photo));
        $status = $tools->delete();
        if ($status) {
            toastr()->success('Xoá dụng cụ thành công thành công!', 'Thông báo', ['timeOut' => 2000]);
        } else {
            toastr()->error('fail!');
        }
        return redirect()->route('tool.list');
    }
}
