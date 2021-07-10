<?php

namespace App\Http\Controllers\Admin;

use App\detail_spending;
use App\Event;
use App\event_tool;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\EventStoreRequest;
use App\Http\Requests\admin\EventUpdateRequest;
use App\Sponsor;
use App\Tools;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('start_day', 'ASC')->with('event_tool')->get();
        return view('admin.pages.event.list')
            ->with('events', $events);

    }

    public function listAgree()
    {
        $events = Event::orderBy('start_day', 'ASC')->with('event_tool')->where('status', Event::STATUS_TRUE)->get();
        return view('admin.pages.event.listagree')
            ->with('events', $events);
    }

    public function listWaitAgree()
    {
        $day = Carbon::now('Asia/Ho_Chi_Minh');
        $events = Event::orderBy('start_day', 'ASC')->with('event_tool')->where('status', Event::STATUS_FALSE)->get();
        return view('admin.pages.event.listwaitagree')
            ->with('events', $events)
            ->with('day', $day);
    }

    public function create()
    {
        $tools = Tools::all();
        return view('admin.pages.event.add')->with('tools', $tools);
    }

    public function store(EventStoreRequest $request)
    {
        $tools = [];
        if ($request->tool) {
            foreach ($request->tool as $key => $tool) {
                if (isset($tool['isCheck']) && $tool['quanlity']) {
                    $tools[$key] = $tool;
                } else if (isset($tool['isCheck']) && !$tool['quanlity']) {
                    toastr()->error('Vui lòng nhập số lượng');
                    return redirect()->back();
                }
            }
        }
        $events = new Event();
        $events->title = $request->title;
        $events->slug = Str::slug($request->title);
        $events->summary = $request->summary;
        $events->content = $request->content;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            if ($image->isValid()) {
                $fileName = time() . "_" . rand(0, 9999999) . "." . $image->getClientOriginalExtension();
                $image->move(public_path('admin/photo/event'), $fileName);
                $events->photo = $fileName;
            }
        }
        $events->budget_estimates = $request->budget_estimates;
        $events->number_of_participants = $request->number_of_participants;
        $events['start_day'] = date("Y-m-d H:i:s", strtotime($request->start_day));
        $events['end_day'] = date("Y-m-d H:i:s", strtotime($request->end_day));
        $events->type = $request->type;
        $events->location = $request->location;
        $events->status = Event::STATUS_FALSE;
        $user = Auth::user()->id;
        $events->user_id = $user;
        $events->save();
        if ($events->save()) {
            foreach ($tools as $key => $tool) {
                $eventTool = Tools::find($key);
                $data['name_event'] = $events->title;
                $data['event_id'] = $events->id;
                $data['quanlity'] = $tool['quanlity'];
                $data['name_tool'] = $eventTool->name;
                $data['tool_id'] = $key;
                $status = event_tool::create($data);
                if (!$status) {
                    toastr()->error('failed!');
                    return back();
                }
            }
        }

        toastr()->success('Thêm sự kiện thành công!', 'Thông báo', ['timeOut' => 2000]);
        return redirect()->route('event.list');
    }

    public function edit($id)
    {
        $eventTool = [];
        $events = Event::find($id);
        $listTool = Tools::all();
        foreach ($events->event_tool as $event_tools) {
            $eventTool[$event_tools->tool_id] = $event_tools;
        }
        return view('admin.pages.event.edit')->with([
            'events' => $events,
            'listTool' => $listTool,
            'eventTool' => $eventTool
        ]);
    }

    public function update(EventUpdateRequest $request)
    {
        $tools = [];
        foreach ($request->tool as $key => $tool) {
            if (isset($tool['isCheck']) && $tool['quanlity']) {
                $tools[$key] = $tool;
            } else if (isset($tool['isCheck']) && !$tool['quanlity']) {
                toastr()->error('Vui lòng nhập số lượng');
                return redirect()->back();
            }
        }
        $events = new Event();
        $events = Event::find($request->id);
        $events->title = $request->title;
        $events->slug = Str::slug($request->title);
        $events->summary = $request->summary;
        $events->content = $request->content;
        if ($request->hasFile('photo')) {
            unlink(public_path('admin/photo/event/' . $events->photo));
            $image = $request->file('photo');
            if ($image->isValid()) {
                $fileName = time() . "_" . rand(0, 9999999) . "." . $image->getClientOriginalExtension();
                $image->move(public_path('admin/photo/event'), $fileName);
                $events->photo = $fileName;
            }
        }
        $events->budget_estimates = $request->budget_estimates;
        $events->number_of_participants = $request->number_of_participants;
        $events['start_day'] = date("Y-m-d H:i:s", strtotime($request->start_day));
        $events['end_day'] = date("Y-m-d H:i:s", strtotime($request->end_day));
        $events->type = $request->type;
        $events->location = $request->location;
        $user = Auth::user()->id;
        $events->user_id = $user;
        $events->save();
        if ($events->save()) {
            event_tool::where('event_id', $request->id)->delete();
            foreach ($tools as $key => $tool) {
                $eventTool = Tools::find($key);
                $data['name_event'] = $events->title;
                $data['event_id'] = $events->id;
                $data['quanlity'] = $tool['quanlity'];
                $data['name_tool'] = $eventTool->name;
                $data['tool_id'] = $key;
                $status = event_tool::create($data);
                if (!$status) {
                    toastr()->error('failed!');
                    return back();
                }
            }
        }
        toastr()->success('Cập nhật sự kiện thành công!', 'Thông báo', ['timeOut' => 2000]);
        return redirect()->route('event.list');
    }

    public function delete($id)
    {
        $events = Event::find($id);
        unlink(public_path('admin/photo/event/' . $events->photo));
        $status = $events->delete();
        if ($status) {
            toastr()->success('Xoá sự kiện thành công!', 'Thông báo', ['timeOut' => 2000]);
        } else {
            toastr()->error('fail!');
        }
        return redirect()->route('event.list');
    }

    public function search(Request $request)
    {
        $events = Event::where('title', 'like', '%' . $request->keyworks . '%')->get();
        return view('admin.pages.event.list', compact('events'));
    }

    public function Agree($id)
    {
        $events = Event::find($id);
        $events->status = Event::STATUS_TRUE;
        $sponsors = Sponsor::all();
        $sum = 0;
        $summ = 0;
        foreach ($sponsors as $item) {
            $sum = $sum + $item->amount_financed;
            $summ = $summ + $item->amount_spent;
        }
        if ($sum - $summ >= $events->budget_estimates) {
            $events->save();
            if ($events->save()) {
                $sponsor = Sponsor::all();
                foreach ($sponsor as $value) {
                    if ($value->amount_financed > $value->amount_spent) {
                        if ($events->budget_estimates < $value->amount_financed - $value->amount_spent) {
                            $tam = $events->budget_estimates;
                            $value->update(['amount_spent' => $value->amount_spent + $tam]);
                            $data = [
                                'event_id' => $id,
                                'sponsor_id' => $value->id,
                                'money' => $tam,
                            ];
                            detail_spending::create($data);
                            break;
                        } else {
                            $tam = $events->budget_estimates - $value->amount_financed + $value->amount_spent;//10000
                            $money = $value->amount_financed - $value->amount_spent;
                            $value->update(['amount_spent' => $value->amount_spent + $value->amount_financed - $value->amount_spent]);
                            $events->budget_estimates = $tam;

                            $data = [
                                'event_id' => $id,
                                'sponsor_id' => $value->id,
                                'money' => $money,
                            ];
                            detail_spending::create($data);
                        }
                    }
                }
                toastr()->success('Duyệt sự kiện thành công!', 'Thông báo', ['timeOut' => 2000]);
                return redirect()->route('event.list.agree');
            } else {
                toastr()->error('fail!');
                return redirect()->back();
            }
        } else {
            toastr()->error('Số tiền tài trợ không đủ!!!');
            return redirect()->back();
        }
    }

    public function unAgree($id)
    {
        $events = Event::find($id);
        unlink(public_path('admin/photo/event/' . $events->photo));
        $status = $events->delete();
        if ($status) {
            toastr()->success('Huỷ sự kiện thành công!', 'Thông báo', ['timeOut' => 2000]);
        } else {
            toastr()->error('fail!');
        }
        return redirect()->route('event.list.wait.agree');
    }
}
