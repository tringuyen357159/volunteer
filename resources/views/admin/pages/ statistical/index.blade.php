@extends('admin.layouts.master')
@section('title')
    Thống kê chi tiết
@endsection
@section('content_head')
    <section class="content-header" style="margin-bottom: 20px">
        <h1>
            THỐNG KÊ TÀI CHÍNH
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a
                ></li>
            <li class="active"> Thống kê tài chính</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="container-fluid"
         style="background-color: #fff; margin:0px 10px; border-radius: 4px; padding:10px 10px; border: 1px solid #ddd;">

        <table id="selectedColumn" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead class="">
            <tr>
                <th class="th-sm" style="text-align: center">Tổng tiền tài trợ</th>
                <th class="th-sm" style="text-align: center">Tổng tiền sử dụng</th>
                {{-- <th>Tóm tắt</th> --}}
                <th class="th-sm" style="text-align: center">Số dư còn lại</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center">{{number_format($sum_amount_financed)}} đ</td>
                    <td style="text-align: center">{{number_format($sum_amount_spent)}} đ</td>
                    <td style="text-align: center">{{number_format($sum_remain)}} đ</td>
                    {{-- <td>{!!$banner -> summary!!}</td> --}}

                </tr>

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
