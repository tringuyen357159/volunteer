@extends('admin.layouts.master')
@section('title')
    Nhân viên
@endsection
@section('content_head')
<section class="content-header" style="margin-bottom: 20px">
    <h1>
      DANH SÁCH NHÂN VIÊN
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
      <li class="active">Nhân viên</li>
    </ol>
  </section>
@endsection

@section('content')
<div class="container-fluid" style="background-color: #fff; margin:0px 10px; border-radius: 4px; padding:10px 10px; border: 1px solid #ddd;">
<div class="text-right" style="margin-bottom: 5px">
    <a href="{{route('employee.create')}}" class="btn btn-primary"><span><i class="fas fa-plus"></i></span> Thêm</a>
</div>
<table id="selectedColumn" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead class="">
            <tr>
                <th class="th-sm">STT</th>
                <th class="th-sm">Tên</th>
                <th class="th-sm">Ảnh</th>
                <th class="th-sm">Giới tính</th>
                <th class="th-sm">Ngày sinh</th>
                <th class="th-sm">Địa chỉ</th>
                <th class="th-sm">Email</th>
                <th class="th-sm">Số điện thoại</th>
                <th class="th-sm">Hành động</th>
            </tr>
          </thead>
          <tbody>
                @foreach ($employee as $key => $employees)
                <tr>
                    <td>{{$key + 1}}</td>
                    {{-- <td> <img src="{{url('photo/user',$user->photo)}}" class="img-user" style=" border-radius: 50%;max-width: 100%;height: auto;" > </td> --}}
                    <td>{{$employees->user->name}}</td>
                    <td><img src="{{url('photo/user',$employees->user->photo)}}" alt="photo" width="60" height="60"></td>
                    <td>@if ($employees->gender == 'male') {{ 'Nam' }} @elseif($employees->gender == 'female') {{ 'Nữ' }} @endif</td>
                    <td>{{date('d-m-Y', strtotime($employees->birthday))}}</td>
                    <td>{{ $employees->address }}</td>
                    <td>{{ $employees->user->email }}</td>
                    <td>{{ $employees->phone }}</td>
                    <td>
                        <a title="Xoá nhân viên" onclick="return confirm('Bạn có chắc muốn xoá nhân viên hay không?')"
                            href="{{route('employee.delete',$employees->user->id )}}" class="btn btn-icon btn-sm btn-danger">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            <tfoot>
            </tfoot>
          </tbody>
</table>
</div>
@endsection

@section('jsblock')
<script type="text/javascript">
$(document).ready(function () {
$('#selectedColumn').DataTable({
  "aaSorting": [],
  "lengthMenu": [[10, 15, 20, -1], [10, 15, 20, "All"]],
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
</script>
<script>
    $("#datepicker").datepicker();
</script>
@endsection
