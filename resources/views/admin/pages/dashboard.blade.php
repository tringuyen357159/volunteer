@extends('admin.layouts.master')
@section('title')
   Thống kê
@endsection
@section('content_head')
    <section class="content-header" style="margin-bottom: 20px">
        <h1>
            Dashboard
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Thống Kê</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$news}}</h3>

                        <p>TIN TỨC</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-fw fa-newspaper-o"></i>
                    </div>
                    <a href="{{route('news.show')}}" class="small-box-footer">Thông tin <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{$events}}</h3>

                        <p>SỰ KIỆN</p>
                    </div>
                    <div class="icon">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                    <a href="{{route('event.list')}}" class="small-box-footer">Thông tin <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{$employees}}</h3>

                        <p>NHÂN VIÊN</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-fw fa-users"></i>
                    </div>
                    <a href="{{route('employee.list')}}" class="small-box-footer">Thông tin <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{$volunteers}}</h3>

                        <p>TÌNH NGUYỆN VIÊN</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-fw fa-users"></i>
                    </div>
                    <a href="{{route('volunteer.show')}}" class="small-box-footer">Thông tin <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-8 connectedSortable ui-sortable">
                <div class="row">
                    <section class="col-sm-6 connectedSortable ui-sortable">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">TIN TỨC</h3>
                            </div>
                            <div class="box-body">
                                {!! $chart1->container() !!}
                            </div>
                        </div>
                    </section>
                    <section class="col-sm-6 connectedSortable ui-sortable">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">SỰ KIỆN</h3>
                            </div>
                            <div class="box-body">
                                {!! $chart2->container() !!}
                            </div>
                        </div>
                    </section>
                    <section class="col-sm-12 connectedSortable ui-sortable">
                        <div class="box box-success">
                            {{-- <div class="box-header with-border">
                                <h3 class="box-title">SỰ KIỆN</h3>
                            </div> --}}
                            <div class="box-body">
                                {!! $chart3->container() !!}
                            </div>
                        </div>

                    </section>
                </div>
            </section>
            <section class="col-lg-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">SỰ KIỆN SẮP DIỄN RA</h3>
                    </div>
                    <div class="box-body">
                        <ul class="timeline timeline-inverse">
                            <!-- timeline time label -->
                            <li class="time-label">
                                  <span class="bg-red">
                                    {{ date('d-m-Y', strtotime($now)) }}
                                  </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            @foreach ($upcomming_event as $item)
                                <li>
                                    <i class="fa fa-fw fa-calendar bg-blue"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> {{ date('d-m-Y h:i:s', strtotime($item->start_day)) }}</span>

                                        <h3 class="timeline-header"><a href="#">{{$item->title}}</a></h3>
                                        <div class="timeline-body">
                                            @if ($item->status==1)
                                                <a class="btn btn-danger btn-xs">Đã duyệt</a>
                                            @else
                                                <a class="btn btn-warning btn-xs">Đang chờ</a>
                                            @endif

                                        </div>
                                    </div>
                                </li>
                        @endforeach
                        <!-- END timeline item -->
                            <li>
                                <i class="fa fa-clock-o bg-gray"></i>
                            </li>
                        </ul>
                    </div>
                </div>

            </section>


        </div>
        <div class="row">

            {{-- <section class="col-lg-4 connectedSortable ui-sortable">

            </section> --}}
        </div>

    </section>
@endsection

@section('jsblock')
    <script src="{{ LarapexChart::cdn() }}"></script>

    <!-- Or use the cdn directly -->

    <!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->

    <!-- Or use the local library as asset the package already provides a publication with this file *see below -->

    {{--<!-- <script src="{{ asset('vendor/larapex-charts/apexchart.js') }}"></script> -->--}}

    {{ $chart1->script() }}
    {{ $chart2->script() }}
    {{ $chart3->script() }}
@endsection

