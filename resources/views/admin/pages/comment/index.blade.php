@extends('admin.layouts.master')
@section('title')
    Bình Luận
@endsection
@section('content_head')
    <section class="content-header" style="margin-bottom: 20px">
        <h1>
            DANH SÁCH BÌNH LUẬN
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li>Bình luận</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="container-fluid"
         style="background-color: #fff; margin:0px 10px; border-radius: 4px; padding:10px 10px; border: 1px solid #ddd;">
        <table id="selectedColumn" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead class="">
            <tr>
                <th class="th-sm">STT</th>
                <th class="th-sm">Người bình luận</th>
                <th class="th-sm">Sự kiện</th>
                <th class="th-sm">Nội dung</th>
                <th class="th-sm">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($comments as $key => $comment)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$comment-> name}}</td>
                    <td>{{$comment-> title}}</td>
                    <td style="word-break: break-word;">{{$comment -> body}}</td>
                    <td>
                        <a title="Xoá" onclick="return confirm('Bạn có chắc muốn xoá hay không?')"
                           href="{{route('comment.delete', $comment->id)}}" class="btn btn-icon btn-sm btn-danger">
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
    <script>
        $("#datepicker").datepicker();
    </script>
@endsection
