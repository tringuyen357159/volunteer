@extends('admin.layouts.master')
@section('title')
    Tin tức
@endsection
@section('content_head')
<section class="content-header" style="margin-bottom: 20px">
    <h1>
      DANH SÁCH TIN TỨC
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
      <li class="active"> Tin tức</a></li>
    </ol>
  </section>
@endsection

@section('content')
<div class="container-fluid" style="background-color: #fff; margin:0px 10px; border-radius: 4px; padding:10px 10px; border: 1px solid #ddd;">
<div class="text-right" style="margin-bottom: 5px">
    <a href="{{route('news.showadd')}}" class="btn btn-primary"><span><i class="fas fa-plus"></i></span> Thêm tin tức</a>
</div>
<table id="selectedColumn" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead class="">
            <tr>
                <th class="th-sm ">STT
                </th>
                <th class="th-sm ">Ảnh
                </th>
                <th class="th-sm ">Tiêu đề
                </th>
                <th class="th-sm ">Người đăng
                </th>
                <th class="th-sm ">Tóm lược
                </th>
                <th class="th-sm ">Loại tin tức
                </th>
                <th class="th-sm ">Hành động
                </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($news as $key => $item)
            <tr>
                <td>{{$key+1}}</td>
                <td><img src="{{url('admin/photo/news/',$item->photo)}}" alt="photo" width="60"></td>
                <td><p>{{$item->title}}</p></td>
                <td><p>{{$item->poster}}</p></td>
                <td><p>{{$item->summary}}</p></td>
                <td>
                   @if ($item->type == 'Volunteering')
                        <p>Tình nguyện</p>
                   @else
                        @if ($item->type == 'Organisations')
                        <p>Tổ chức</p>
                        @else
                        <p>Blog</p>
                        @endif
                   @endif

                </td>
                <td>
                    <a title="Sửa" href="{{route('news.edit',$item->id)}}" class="btn btn-icon btn-sm btn btn-success">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a title="Xoá" onclick="return confirm('Bạn có chắc muốn xoá hay không?')"
                        href="{{route('news.delete',$item->id)}}" class="btn btn-icon btn-sm btn-danger">
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
</script>
@endsection


