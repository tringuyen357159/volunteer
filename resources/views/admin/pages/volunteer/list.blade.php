@extends('admin.layouts.master')
@section('title')
   Tình nguyện viên
@endsection
@section('content_head')
<section class="content-header" style="margin-bottom: 20px">
    <h1>
      DANH SÁCH TÌNH NGUYỆN VIÊN
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
      <li class="active">Tình nguyện viên</li>
     </ol>
  </section>
@endsection
@section('content')
<div class="container-fluid" style="background-color: #fff; margin:0px 10px; border-radius: 4px; padding:10px 10px; border: 1px solid #ddd;">
<div class="text-right" style="margin-bottom: 5px">
    {{-- <a href="{{route('volunteer.add')}}" class="btn btn-primary"><span><i class="fas fa-plus"></i></span> Add News</a> --}}
</div>
<table id="selectedColumn" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead >
            <tr>
                <th class="th-sm">STT
                </th>
                 <th class="th-sm">Ảnh
                </th>
                <th class="th-sm">Tên
                </th>
                <th class="th-sm">Email
                </th>
                <th class="th-sm">Giới tính
                </th>
                <th class="th-sm">Ngày sinh
                </th>
                <th class="th-sm">Số điện thoại
                </th>
                <th class="th-sm">Địa chỉ
                </th>
                <th class="th-sm">Hành động
                </th>

            </tr>
          </thead>
          <tbody>
            @foreach ($volunteers as $key => $volunteer)
            @if ($volunteer->user->status == "active")
                <tr>
                    <td>{{ $key + 1 }}</td>
                        <td><img src="{{url('photo/user',$volunteer->user->photo)}}" alt="photo" width="60" height="60"></td>
                        <td>{{ $volunteer->user->name }} </td>
                        <td>{{ $volunteer->user->email }}</td>
                        <td>
                            @if ($volunteer->gender == 'male') {{ 'Nam' }} @elseif($volunteer->gender == 'female') {{ 'Nữ' }} @endif
                        </td>
                        <td>{{date('d-m-Y', strtotime($volunteer->birthday))}}</td>
                        <td>{{ $volunteer->phone }}</td>
                        <td>{{ $volunteer->address }}</td>

                    <td>

                        @if (!$volunteer->user->active_at)
                        <a title= "Khoá tài khoản" href="#" class="btn btn-icon btn-sm btn-danger" data-toggle="modal" data-target="#exampleModalLong" onclick="setUserId({{ $volunteer ->user->id }})">
                            <i class="fas fa-lock"></i>
                        </a>
                        @else
                            <a onclick="return confirm('Bạn có chắc muốn mở khoá hay không?')"
                            href="{{route('volunteer.openactive',$volunteer ->user->id )}}" class="btn btn-icon btn-sm btn-danger"  >
                                <i class="fas fa-lock-open"></i>
                            </a>
                        @endif
                        @if ($volunteer->isShow)
                            <a title="Chỉ định thành nhân viên" onclick="return confirm('Bạn muốn chỉ định tình nguyện viên này thành nhân viên ?')"
                            href="{{route('volunteer.edit',$volunteer->user->id )}}" class="btn btn-icon btn-sm btn-info"  >
                            <i class="fas fa-user-check"></i>
                            </a>
                        @endif
                    </td>
                </tr>
            @endif
            @endforeach
          </tbody>
</table>
</div>
@include('admin.pages.volunteer.set_active_user')
@endsection
@section('jsblock')
<script type="text/javascript">
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

});
function setUserId(id) {
    console.log(id);
    $('#userId').val(id);
}
</script>
@endsection
