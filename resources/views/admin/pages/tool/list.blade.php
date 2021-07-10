@extends('admin.layouts.master')
@section('title')
    Công cụ
@endsection
@section('content_head')
<section class="content-header" style="margin-bottom: 20px">
    <h1>
      DANH SÁCH DỤNG CỤ
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a
        ></li>
      <li class="active"> Dụng cụ</li>
    </ol>
  </section>
@endsection

@section('content')
<div class="container-fluid" style="background-color: #fff; margin:0px 10px; border-radius: 4px; padding:10px 10px; border: 1px solid #ddd;">
    <div class="text-right" style="margin-bottom: 5px">
        <a href="{{route('tool.show')}}" class="btn btn-primary"><span><i class="fas fa-plus"></i></span> Thêm dụng cụ</a>
    </div>
<table id="selectedColumn" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th class="th-sm">STT
        </th>
        <th class="th-sm">Tên dụng cụ
        </th>
        <th class="th-sm">Ảnh
        </th>
        <th class="th-sm">Hành động
        </th>
      </tr>
    </thead>
    <tbody>
        @foreach ($tools as $key=> $tool)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$tool->name}}</td>
                    <td><img src="{{url('admin/photo/tool',$tool->photo)}}" alt="photo" width="60" height="50"></td>
                    <td>
                        <a title="Sửa" href="{{route('tool.edit',$tool->id)}}" class="btn btn-icon btn-sm btn btn-success">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a title="Xoá" onclick="return confirm('Bạn có chắc muốn xoá hay không?')"
                            href="{{route('tool.delete',$tool->id)}}" class="btn btn-icon btn-sm btn-danger">
                            <i class="fas fa-trash-alt"></i>
                        </a>
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
