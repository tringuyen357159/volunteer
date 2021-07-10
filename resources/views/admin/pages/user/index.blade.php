@extends('admin.layouts.master')
@section('title')
    Nhân viên
@endsection
@section('content_head')
<section class="content-header" style="margin-bottom: 20px">
    <h1>
      DANH SÁCH QUYỀN NHÂN VIÊN
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
      <li class="active">Quyền nhân viên</li>
    </ol>
  </section>
@endsection

@section('content')
<div class="container-fluid" style="background-color: #fff; margin:0px 10px; border-radius: 4px; padding:10px 10px; border: 1px solid #ddd;">
<table id="selectedColumn" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead class="">
            <tr>
                <th class="th-sm">STT</th>
                <th class="th-sm">Tên nhân viên</th>
                <th class="th-sm">Email</th>
                <th class="th-sm">Nhóm Quyền</th>
                <th class="th-sm">Hành động
                </th>
            </tr>
          </thead>
          <tbody>
                @foreach ($users as $key => $user)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$user -> name}}</td>
                    <td>{{$user -> email}}</td>
                    <td>{{$user -> display_name}}</td>
                    <td>
                        <a href="{{route('user.edit', $user->id)}}" class="btn btn-icon btn-sm btn btn-warning">
                            <i class="fas fa-edit"></i>
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
