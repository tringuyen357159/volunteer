@extends('admin.layouts.master')
@section('title')
    Nhóm Quyền
@endsection
@section('content_head')
    <section class="content-header" style="margin-bottom: 20px">
        <h1>
            DANH SÁCH NHÓM QUYỀN
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Quyền</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="container-fluid"
         style="background-color: #fff; margin:0px 10px; border-radius: 4px; padding:10px 10px; border: 1px solid #ddd;">
        <div class="text-right" style="margin-bottom: 5px">
            <a href="{{route('role.create')}}" class="btn btn-primary"><span><i class="fas fa-plus"></i></span> Thêm</a>
        </div>
        <table id="selectedColumn" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead class="">
            <tr>
                <th class="th-sm">STT</th>
                {{-- <th class="th-sm">Tên</th> --}}
                <th class="th-sm">Hiển thị</th>
                <th class="th-sm">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($roles as $key => $role)
                <tr>
                    <td>{{$key + 1}}</td>
                    {{-- <td>{{$role -> name}}</td> --}}
                    <td>
                        @if ($role -> name == 'Admin')
                             <span class="label label-danger">Quản trị viên</span>
                        @else
                            <span class="label label-info">{{$role -> display_name}}</span>
                        @endif
                    </td>
                    <td>
                        <a title="Sửa" href="{{route('role.edit', $role->id)}}" class="btn btn-icon btn-sm btn btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a title="Xoá" onclick="return confirm('Bạn có chắc muốn xoá hay không?')"
                           href="{{route('role.delete', $role->id)}}" class="btn btn-icon btn-sm btn-danger">
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
                    targets: 2
                }]

            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
    <script>
        $("#datepicker").datepicker();
    </script>
@endsection
