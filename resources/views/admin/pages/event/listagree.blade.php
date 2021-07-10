@extends('admin.layouts.master')
@section('title')
   Sự kiện đã phê duyệt
@endsection
@section('content_head')
<section class="content-header" style="margin-bottom: 20px">
    <h1>
      DANH SÁCH SỰ KIỆN ĐÃ PHÊ DUYỆT
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a
        ></li>
      <li class="active"> Sự kiện đã phê duyệt</li>
    </ol>
  </section>
@endsection

@section('content')
<div class="container-fluid" style="background-color: #fff; margin:0px 10px; border-radius: 4px; padding:10px 10px; border: 1px solid #ddd;">
<table id="selectedColumn" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th class="th-sm">STT
        </th>
        <th class="th-sm">Tiêu đề
        </th>
        <th class="th-sm">Nội dung
        </th>
        <th class="th-sm">Ảnh
        </th>
        <th class="th-sm">Kinh phí
        </th>
        <th class="th-sm">Số người tham gia
        </th>
        <th class="th-sm">Ngày bắt đầu
        </th>
        <th class="th-sm">Ngày kết thúc
        </th>
        <th class="th-sm">Loại sự kiện
        </th>
        <th class="th-sm">Dụng cụ, số lượng
        </th>
        <th class="th-sm">Địa điểm
        </th>
        <th class="th-sm">Trạng thái
        </th>
      </tr>
    </thead>
    <tbody>
        @foreach ($events as $key=> $event)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$event->title}}</td>
                    <td>
                        <p style="-webkit-line-clamp: 3;overflow: hidden;text-overflow: ellipsis; -webkit-box-orient: vertical;display: -webkit-box;">
                            {{$event->summary}}
                        </p>
                    </td>
                    {{-- <td>{!!$event->content!!}</td> --}}
                    <td><img src="{{url('admin/photo/event',$event->photo)}}" alt="photo" width="60" height="50"></td>
                    <td>{{$event->budget_estimates}}</td>
                    <td>{{$event->number_of_participants}}</td>
                    <td>{{ date('d-m-Y h:i:s', strtotime($event->start_day)) }}</td>
                    <td>{{ date('d-m-Y h:i:s', strtotime($event->end_day)) }}</td>
                    <td>
                        @if ($event->type=="môi trường")
                            <span class="">môi trường</span>
                        @elseif ($event->type=="thể thao")
                            <span class="">thể thao</span>
                        @else
                            <span class="">quyên tặng</span>
                        @endif
                    </td>
                    <td>
                        @foreach ( $event->event_tool as $item)
                            <span>{{$item->name_tool}}:{{$item->quanlity}} cái </span>
                            <br>
                        @endforeach
                    </td>
                    <td>{{$event->location}}</td>
                    <td>
                        @if ($event->status == 1)
                           <span class="label label-success"> ĐÃ DUYỆT</span>
                        @endif

                    </td>
                </tr>
        @endforeach

    </tbody>

  </table>
</div>
@endsection

@section('jsblock')
<script>
        $(document).ready(function () {
        $('#selectedColumn').DataTable({
            "aaSorting": [],
            "lengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]],
            "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Vietnamese.json"
        },
            columnDefs: [{
                orderable: false,
                targets: 3
            }]
        });
        $('.dataTables_length').addClass('bs-select');
        })
</script>

@endsection
