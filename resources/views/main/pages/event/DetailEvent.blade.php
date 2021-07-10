<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" rel="stylesheet"> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" rel="stylesheet">
@extends('main.layouts.main')
@section('body')
<div class="detail_event">
    <!-- <section class="banner-page">
        <img src="{{url('admin/photo/event',$event_detail->photo)}}" alt="">
    </section> -->
    <form action="{{route('client.event.register')}}" method="post">
    @csrf
        <section class="detail-content">
            <div class="bg-content">
                <div class="img-banner">
                    <img src="{{url('admin/photo/event',$event_detail->photo)}}" alt="">
                </div>
                <div class="content-header">
                    <input type="hidden" name="event_id" value="{{ $event_detail->id }}">
                    <div class='row full-box'>
                        <div class="col-md-12">
                            <h3>{{$event_detail->title}}</h3>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-md-12">
                            <i class="fa fa-clock-o"></i>
                            <span>Bắt Đầu: {{date('H:i d/m/Y', strtotime($event_detail->start_day))}}</span>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-md-12">
                            <i class="fa fa-clock-o"></i>
                            <span>Kết Thúc: {{date('H:i d/m/Y', strtotime($event_detail->end_day))}}</span>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-md-12">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Địa Chỉ: {{$event_detail->location}}</span>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-md-12">
                            <i class="fas fa-globe-americas"></i>
                            <span>Loại: {{$event_detail->type}}</span>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-md-12">
                            <i class="fas fa-coins"></i>
                            <span>Kinh Phí Dự Trù: {{$event_detail->budget_estimates}}</span>
                        </div>
                    </div>
                    <!-- <div class='row'>
                        <div class="col-md-12">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Địa Chỉ: {{$event_detail->location}}</span>
                        </div>
                    </div> -->
                    <div class='row'>
                        <div class="col-md-12">
                            <i class="fas fa-user"></i>
                            <span>
                                @if ($event_detail->real_quantity>0)
                                    <span style="border-top: none"> {{$event_detail->real_quantity}}/{{$event_detail->number_of_participants}} Người</span>
                                @else
                                <span style="border-top: none"> {{$event_detail->number_of_participants}} Người</span>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class='row full-box'>
                        <div class="col-md-12">
                            <span>
                                @if(!$event_tool->isEmpty())
                                    <h4>Đăng Kí Dụng Cụ:</h4>
                                    @foreach ($event_tool as $item)
                                    <div style="display: block">
                                        @if ($item->quanlity > $item->real_quanlity)
                                            <input class="reply" type="checkbox" value="1" name="tool[{{ $item->tool_id }}][isCheck]" > {{$item->name_tool}}
                                        @endif
                                        @if ($item->quanlity > $item->real_quanlity)
                                            <input class="form-control ip-quality" type="number" placeholder="Số lượng" name="tool[{{ $item->tool_id }}][quanlity]" value="{{old('quanlity')}}"  max="{{ $item->quanlity - $item->real_quanlity }}" min="0"
                                            style="display: none">
                                        @endif
                                    </div>
                                    @endforeach
                                @else
                                    <span></span>
                                @endif
                            </span>
                        </div>
                    </div>
                    @if ($event_detail->start_day > $day)
                        <button class="btn-event" type="submit">Đăng ký</button>
                    @endif

                </div>
                <div class="main-content">
                    <h3>{{$event_detail->title}}</h3>
                    <p>
                        {!!$event_detail->content!!}
                    </p>
                </div>
            </form>
                <div class="comment">
                    <div class="title-comment">
                        <i class="far fa-comments"></i>
                        <h3>Bình luận</h3>
                    </div>
                    @php
                        $user = DB::table('users')->where('email', session()->get('user'))->first();
                    @endphp
                        <form method="post" action="{{ route('comment.event') }}">
                            @csrf
                            <div class="ip-comment">
                                <div class="rounded-circle">
                                    @if ($user)
                                        <img src="{{url('photo/user/', $user->photo)}}" alt="">
                                    @else
                                        <img src="{{asset('home/img/mm.png')}}" alt="">
                                    @endif
                                </div>
                                <input type=hidden name=event_id value="{{ $event_detail->id }}" />
                                <input type=hidden name=event_name value="{{ $event_detail->title }}" />
                                <input type="text" name="body"  placeholder="Nhập bình luận...">
                            </div>

                        </form>
                    <div class="list-comment">
                        @include('main.pages.event.commentsDisplay', ['comments' => $event_detail->comments, 'event_id' => $event_detail->id])
                    </div>
                </div>
                <div class="header-event-first">
                <h3 data-aos="fade-up" data-aos-down="2000">Sự kiện sắp diễn ra</h3>
            </div>
                <div class="row">
                    @foreach ($event_random as $item)
                    <div class="col-md-4" data-aos="fade-up" data-aos-duration="2000">
                       <div class="single-blog-item">
                                <div class="blog-thumnail" style="height:220px;">
                                    <a href="{{route('client.detailevent',$item->slug)}}">
                                        <img  style="height:220px;" src="{{url('admin/photo/event',$item->photo)}}"  alt="blog-img">
                                    </a>
                                </div>
                                <div class="blog-content">
                                    <h4><a href="{{route('client.detailevent',$item->slug)}}"><p style="-webkit-line-clamp: 1;overflow: hidden;text-overflow: ellipsis; -webkit-box-orient: vertical;display: -webkit-box;font-size: 15px;font-weight: 600;color: black">
                                        {{$item->title}}</p></a></h4>
                                    <p style="-webkit-line-clamp: 3;overflow: hidden;text-overflow: ellipsis; -webkit-box-orient: vertical;display: -webkit-box;">
                                        {{$item->summary}}</p>
                                    <a href="{{route('client.detailevent',$item->slug)}}" class="more-btn">Xem Thêm</a>
                                </div>
                                <span class="blog-date">{{date('d-m-Y', strtotime($item->start_day))}}</span>
                            </div>
                     </div>
                     @endforeach
                </div>
            </div>
        </section>


</div>
@endsection
@section('jsblock')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.reply').click(function () {
            $(this).next().toggleClass('d-notnone')
            })
        })
    </script>
@endsection
