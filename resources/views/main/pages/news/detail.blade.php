@extends('main.layouts.main')
@section('body')
<div id="blog" class="container">
    <div class="new1-container">
        <div class="row-top">
            <div class="row-top-header">
               <h2 style="font-size: 35px; font-family: 'Noto Serif', serif; font-weight: 700; font-size: 42px" >{{$news_detail->title}}</h2>
               <br>
               <div class="expert">
               <div class="left-side text-left" style="">
                <p class="left_side">
                   <span class="clock" style="font-size: 14px"><i class="fa fa-clock-o"></i></span>
                   <span class="time" style="font-size: 14px">{{date('d-m-Y', strtotime($news_detail->created_at)) }}</span>
                   <a href=""><span class="admin" style="font-size: 14px; font-weight: 700 "> {{$news_detail->poster}}</span></a>
                </p>

             </div>
            </div>

            </div>
            <div class="row-top-container" style="border-bottom: 1px solid rgb(209, 206, 206); padding-bottom: 50px;
            margin-bottom: 20px;">
                <p>{!!$news_detail->content!!}</p>
            </div>
            <div class="sidebar-right">
                <div class="sidebar-right-header">
                    <h3 style="font-size: 30px; font-family: 'Noto Serif', serif; margin-bottom: 10px">Đọc tiếp</h3>
                </div>
            </div>
        </div>
        <!--End of row-->
               <div class="row">
                @foreach ($news_random as $item)
                  <div class="col-md-4">
                     <div class="blog_news">
                        <div class="single_blog_item">
                           <div class="blog_img">
                                <a href="{{route('news.detailnews',$item->slug)}}">
                                    <img src="{{url('admin/photo/news/',$item->photo)}}" alt="">
                                </a>
                           </div>
                           <div class="blog_content">
                              <a href="">
                                 <h3 style="overflow: hidden;
                                 text-overflow: ellipsis;
                                 line-height: 30px;
                                 -webkit-line-clamp: 2;
                                 height: 60px;
                                 display: -webkit-box;
                                 -webkit-box-orient: vertical;">{{$item->title}}</h3>
                              </a>
                              <div class="expert" style="margin-top: 10px">
                                 <div class="left-side text-left">
                                    <p class="left_side">
                                       <span class="clock"><i class="fa fa-clock-o"></i></span>
                                       <span class="time">{{date('d-m-Y', strtotime($item->created_at)) }}</span>
                                       <a href="{{route('news.detailnews',$item->slug)}}"><span class="admin"><i class="fa fa-user"></i> {{$item->poster}}</span></a>
                                    </p>
                                </div>
                              </div>
                              <p style="overflow: hidden;
                              text-overflow: ellipsis;
                              line-height: 20px;
                              -webkit-line-clamp: 4;
                              height: 80px;
                              display: -webkit-box;
                              -webkit-box-orient: vertical;margin-bottom: 10px" class="blog_news_content"> {{$item->summary}}</p>
                              <a href="{{route('news.detailnews',$item->slug)}}" class="blog_link">đọc thêm</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  @endforeach
               </div>
               <!--End of row-->

            <!--End of container-->
        </div>
    </div>
</div>
@endsection
