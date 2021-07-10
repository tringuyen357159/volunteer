@extends('admin.layouts.master')
@section('title')
    Nhà tài trợ
@endsection
@section('content_head')
    <section class="content-header" style="margin-bottom: 20px">
        <h1>
            DANH SÁCH NHÀ TÀI TRỢ
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}">Trang chủ</a></li>
            <li class="active">Nhà tài trợ</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Danh sách nhà tài trợ</a></li>
            <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">Danh sách tài khoản (chưa phải nhà
                    tài trợ)</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="activity">
                <div class="container-fluid"
                     style="background-color: #fff; margin:0px 10px; border-radius: 4px; padding:10px 10px; border: 1px solid #ddd;">
                    <div class="text-right" style="margin-bottom: 5px">
                        <a href="{{route('sponsor.show')}}" class="btn btn-primary"><span><i
                                    class="fas fa-plus"></i></span> Thêm nhà tài trợ</a>
                    </div>
                    <table id="bang1" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead class="">
                        <tr>
                            <th class="th-sm ">STT
                            </th>
                            <th class="th-sm ">Tên nhà tài trợ
                            </th>
                            <th class="th-sm ">SĐT
                            </th>
                            <th class="th-sm ">Email
                            </th>
                            <th class="th-sm ">Địa chỉ
                            </th>
                            <th class="th-sm ">Hình thức tài trợ
                            </th>
                            <th class="th-sm ">Số tiền tài trợ
                            </th>
                            <th class="th-sm ">Đã dùng
                            </th>
                            <th class="th-sm ">Ẩn danh
                            </th>
                            <th class="th-sm ">Hành động
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($sponsor as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->name}}</td>
                                @if ($item->anonymous === 1)
                                    <td>******{{substr($item->phone,-4)}}</td>
                                @else
                                    <td>{{$item->phone}}</td>
                                @endif
                                @if ($item->anonymous === 1)
                                    <td>******{{substr($item->email,-13)}}</td>
                                @else
                                    <td>{{$item->email}}</td>
                                @endif
                                <td>{{$item->address}}</td>
                                <td>
                                    @if ($item->method=='card')
                                        <span class="label label-success">Thẻ điện thoại</span>
                                    @elseif ($item->method=='bank')
                                        <span class="label label-warning">Ngân hàng</span>
                                    @else
                                        <span class="label label-primary">Trực tiếp</span>
                                    @endif
                                </td>
                                <td>
                                    {{number_format($item->amount_financed)}} đ
                                </td>
                                <td>
                                    {{number_format($item->amount_spent)}} đ
                                </td>
                                <td>
                                    @if ($item->anonymous==1)
                                        <span class="label label-warning">Có</span>
                                    @else
                                        <span class="label label-success">Không</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->user_id!=null)
                                        <a title="Tài trợ tiền" href="{{route('sponsor.showdonate',$item->id)}}"
                                           class="btn btn-icon btn-sm btn btn-warning">
                                            <i class="fas fa-donate"></i>
                                        </a>
                                        <a title="Sửa" href="{{route('sponsor.edit',$item->id)}}"
                                           class="btn btn-icon btn-sm btn btn-success">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a title="Xoá" onclick="return confirm('Bạn có chắc muốn xoá hay không?')"
                                           href="{{route('sponsor.delete',$item->id)}}"
                                           class="btn btn-icon btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    @else
                                        <a title="Tài trợ tiền" href="{{route('sponsor.showdonate',$item->id)}}"
                                           class="btn btn-icon btn-sm btn btn-warning">
                                            <i class="fas fa-donate"></i>
                                        </a>
                                        <a title="Tạo tài khoản" onclick="return confirm('Tạo tài khoản?')"
                                           href="{{route('user.parse',$item->id)}}"
                                           class="btn btn-icon btn-sm btn btn-info">
                                            <i class="fas fa-user"></i>
                                        </a>
                                        <a title="Sửa" href="{{route('sponsor.edit',$item->id)}}"
                                           class="btn btn-icon btn-sm btn btn-success">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a title="Xoá" onclick="return confirm('Bạn có chắc muốn xoá hay không?')"
                                           href="{{route('sponsor.delete',$item->id)}}"
                                           class="btn btn-icon btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        <tfoot>
                        </tfoot>
                        </tbody>
                    </table>
                </div>


            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="timeline">
                <div class="container-fluid"
                     style="background-color: #fff; margin:0px 10px; border-radius: 4px; padding:10px 10px; border: 1px solid #ddd;">
                    <div class="text-right" style="margin-bottom: 5px">
                        {{-- <a href="{{route('sponsor.show')}}" class="btn btn-primary"><span><i class="fas fa-plus"></i></span> Thêm nhà tài trợ</a> --}}
                    </div>
                    <table id="bang2" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead class="">
                        <tr>
                            <th class="th-sm ">STT
                            </th>
                            <th class="th-sm ">Username
                            </th>
                            <th class="th-sm ">Email
                            </th>
                            <th class="th-sm ">Hành động
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>
                                    <a title="Tài trợ tiền" onclick="return confirm('Tài trợ tiền')"
                                       href="{{route('sponser.parse',$item->id)}}"
                                       class="btn btn-icon btn-sm btn btn-warning">
                                       <i class="fas fa-donate"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        <tfoot>
                        </tfoot>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>

@endsection
@section('jsblock')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#bang1').DataTable({
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

    <script type="text/javascript">
        $(document).ready(function () {
            $('#bang2').DataTable({
                "aaSorting": [],
                "lengthMenu": [[7, 15, 20, -1], [7, 15, 20, "All"]],
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


