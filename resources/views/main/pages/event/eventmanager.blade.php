@extends('main.layouts.main')


@section('body')
<div class="box-manager">
    <div class="container">
    <div class="header-manager">
        <h1>Sự Kiện Đã Đăng Kí</h1>
    </div>
    <div class="header-manager">
        <h2 style="color: rgb(245, 103, 8)">Lưu ý : Bạn không thể huỷ sự kiện trước 1 ngày sự kiện đó xảy ra !!!
        </h2>
    </div>
    <table>
        <tr class="header-table">
            <th class="col-name">Tên Sự Kiện</th>
            <th class="col-img">Ảnh</th>
            <th class="col">Ngày Bắt Đầu</th>
            <th class="col">Ngày Kết Thúc</th>
            <th class="col">Dụng Cụ Đã Chọn</th>
            <th class="col">Địa Điểm</th>
            <th  class="col-del">Hành động</th>
        </tr>
        {{-- @if ($event_register == '')
        <tr style="height: 50px;">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
       @else --}}
        @foreach ($event_register as $item)
        @if (strtotime($item->event->start_day)-strtotime($day) < 0)
            <tr style="color: rgb(212, 212, 212);">
        @else
            <tr >
        @endif
                <td class="col-name">{{$item->event->title}}</td>
                <td class="col-img">
                    @if (strtotime($item->event->start_day)-strtotime($day) < 0)
                        <img src="{{url('admin/photo/event/',$item->event->photo)}}" alt="photo" style="opacity: 0.2;">
                    @else
                        <img src="{{url('admin/photo/event/',$item->event->photo)}}" alt="photo">
                    @endif
                </td>
                <td class="col">{{ date('H:i d/m/Y', strtotime($item->event->start_day)) }}</td>
                <td class="col">{{ date('H:i d/m/Y', strtotime($item->event->end_day)) }}</td>
                <td class="col">
                @foreach ($item->toolVolunteer as $value)
                    {{$value->name_tool}}:{{$value->quanlity}} cái
                    <br>
                @endforeach
                </td>
                <td class="col">{{$item->event->location}}</td>
                <td class="col-del">
                    @if (strtotime($item->event->start_day)-strtotime($day) < 0)
                        <span href="" class="del-event" style="opacity: 0.5;">
                        HUỶ
                        </span>
                    @else
                    <a href="{{route('client.deleteevent',['event_id' => $item->event_id, 'user_id' => $item->user_id] )}}" class="del-event"

                        onclick="return confirm('Bạn có chắc muốn huỷ hay không?')">
                    HUỶ
                    </a>
                    @endif
                </td>
            </tr>

        @endforeach
        {{-- @endif --}}
    </table>
    <div>{{$event_register->links()}}</div>
    </div>
</div>


@endsection
