@extends('admin.layouts.master')
@section('title')
    Danh sách sự kiện đăng ký
@endsection
@section('content_head')
<section class="content-header" style="margin-bottom: 20px">
    <h1>
      DANH SÁCH SỰ KIỆN ĐĂNG KÝ
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a
        ></li>
      <li class="active"><a href=""> Sự kiện đăng ký</a
        ></li>
    </ol>
  </section>
@endsection
@section('content')
<div class="container-fluid" style="background-color: #fff; margin:0px 10px; border-radius: 4px; padding:10px 10px; border: 1px solid #ddd;">
  <table id="selectedColumn" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <div style="margin-bottom: 10px" id="list"></div>
    <thead>
      <tr>
        <th style="display: none" class="th-sm">Tên sự kiện
        </th>
        <th class="th-sm" style="width: 180px;">Tên tình nguyện viên
        </th>
        <th class="th-sm">SĐT
        </th>
        <th class="th-sm">Ngày sinh
        </th>
        <th class="th-sm">Địa chỉ
        </th>
        <th class="th-sm">Dụng cụ, số lượng
        </th>
      </tr>
    </thead>
    <tbody>
        @foreach ($eventVolunteer as $key => $item)

                <tr>
                    <td style="display: none">{{$item->event_name	}}</td>
                    <td>{{$item->user_name}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{$item->birthday}}</td>
                    <td>{{$item->address}}</td>
                    <td>
                        @foreach ($item->toolVolunteer as $value)
                            {{$value->name_tool}}:{{$value->quanlity}} cái
                            <br>
                        @endforeach
                    </td>
                </tr>
            @endforeach

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
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Vietnamese.json",
        },
            columnDefs: [{
                orderable: false,
                targets: 3
            }],
            dom: 'Bfrtip',
            buttons: [
            'excel'
            ],
            initComplete: function () {
            this.api().columns([0, 0, 0]).every( function () {
                var column = this;
                var select = $('<select class="form-control input-sm"><option value="">Tất cả sự kiện</option></select>')
                    .appendTo( $('#list'))
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }

        });
        $('.dataTables_length').addClass('bs-select');
        })
</script>



@endsection
