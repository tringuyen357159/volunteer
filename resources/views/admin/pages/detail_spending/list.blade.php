@extends('admin.layouts.master')
@section('title')
    Chi tiết chi tiêu
@endsection
@section('content_head')
<section class="content-header" style="margin-bottom: 20px">
    <h1>
      DANH SÁCH CHI TIẾT CHI TIÊU
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a
        ></li>
        <li class="active">Chi tiết chi tiêu</li>
    </ol>
  </section>
@endsection

@section('content')
<div class="container-fluid" style="background-color: #fff; margin:0px 10px; border-radius: 4px; padding:10px 10px; border: 1px solid #ddd;">
<table id="selectedColumn" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th class="th-sm">STT
        </th>
        <th class="th-sm">Tên nhà tài trợ
        </th>
        <th class="th-sm">Tên sự kiện
        </th>
        <th class="th-sm">Tiền
        </th>
        <th class="th-sm">Ngày tạo
        </th>
      </tr>
    </thead>
    <tbody>
        @foreach ($detail_spending as $key=> $detail_spendings)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$detail_spendings->name}}</td>
                    <td>{{$detail_spendings->title}}</td>
                    <td>{{number_format($detail_spendings->money)}} đ</td>
                    <td>{{ date('d-m-Y', strtotime($detail_spendings->created_at)) }}</td>
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
