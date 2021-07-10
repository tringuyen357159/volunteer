@extends('admin.layouts.master')
@section('title')
    Phản hồi
@endsection
@section('content_head')
<section class="content-header" style="margin-bottom: 20px">
    <h1>
      DANH SÁCH LIÊN HỆ
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
      <li class="active">Liên hệ</li>
    </ol>
  </section>
@endsection

@section('content')
<div class="container-fluid" style="background-color: #fff; margin:0px 10px; border-radius: 4px; padding:10px 10px; border: 1px solid #ddd;">
<table id="selectedColumn" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead class="">
            <tr>
                <th class="th-sm">Người gửi
                </th>
                <th class="th-sm">Email
                </th>
                <th class="th-sm">Địa chỉ
                </th>
                <th class="th-sm">Số điện thoại
                </th>
                <th class="th-sm">Nội dung
                </th>
                <th class="th-sm">Ngày gửi
                </th>
                <th class="th-sm">Hành động</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($feedback as $key => $item)
            <tr>
                <td><p>{{$item->name}}</p></td>
                <td><p>{{$item->email}}</p></td>
                <td><p>{{$item->address}}</p></td>
                <td><p>{{$item->phone}}</p></td>
                <td>
                    <p>{{$item->content}}</p></td>
                </td>
                <td>
                    <p>{{date('d-m-Y H:i', strtotime($item->created_at)) }}</p></td>
                </td>
                <td>
                    <a title="Xoá" onclick="return confirm('Bạn có chắc muốn xoá hay không?')"
                        href="{{route('feedback.delete',$item->id)}}" class="btn btn-icon btn-sm btn-danger">
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
  "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
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
@endsection
