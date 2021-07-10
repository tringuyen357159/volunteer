@extends('main.layouts.main')
@section('title')
    Trang chủ
@endsection
@section('body')
<style>
    .blog_news{
        box-shadow: 0px 20px 30px 5px rgb(61 1 4 / 10%);
    }
</style>

<!--Start of slider section-->
<section id="slider">
   <div id="carousel-example-generic" class="carousel slide carousel-fade" data-ride="carousel" data-interval="3000">
      <!-- Indicators -->
      <ol class="carousel-indicators">
         <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
         <li data-target="#carousel-example-generic" data-slide-to="1"></li>
         <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        @foreach ($banners as $keys => $items)
        @if ($keys == 0)
        <div class="item active">
            <div class="slider_overlay">
               <img src="{{url('photo/banner/',$items->photo)}}" alt="...">
               <div class="carousel-caption" style="top: 14%">
                  <div class="slider_text">
                     <h3 style="line-height: 1.3">{{$items->title}}</h3>
                     <p>{!!$items->summary!!}</p>
                     <a href="{{route('client.getRegister')}}" class="custom_btn">Tham gia ngay</a>
                  </div>
               </div>
            </div>
         </div>
        @else
        <div class="item">
            <div class="slider_overlay">
               <img src="{{url('photo/banner',$items->photo)}}" alt="...">
               <div class="carousel-caption" style="top: 14%">
                  <div class="slider_text">
                     <h3 style="line-height: 1.3">{{$items->title}}</h3>
                     <p>{!!$items->summary!!}</p>
                     <a href="{{route('client.getRegister')}}" class="custom_btn">Tham gia ngay</a>
                  </div>
               </div>
            </div>
         </div>
        @endif
        @endforeach

      </div>
      <!--End of Carousel Inner-->
   </div>
</section>
<!--end of slider section-->
<!--Start of welcome section-->
<section id="welcome">
<div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="wel_header" data-aos="fade-down" data-aos-duration="2000">
               <h2 >Chào Mừng Đến Với Tình Nguyện Duy Tân</h2>
               <p>Nơi cùng nhau tham gia hoạt động tình nguyện, cùng trở thành tình nguyện viên để chung tay bảo vệ</p>
            </div>
         </div>
      </div>
      <!--End of row-->
      <div class="row" data-aos="fade-up" data-aos-duration="2000">
         <div class="col-md-4">
            <div class="item">
               <div class="single_item">
                  <div class="item_list">
                     <div class="welcome_icon">
                        <i class="fa fa-users"></i>
                     </div>
                     <h4>Trở thành tình nguyện viên</h4>
                     <p>Bạn muốn làm tình nguyện viên,
                         hãy đến với chúng tôi
                     </p>
                  </div>
               </div>
            </div>
         </div>
         <!--End of col-md-3-->
         <div class="col-md-4">
            <div class="item">
               <div class="single_item">
                  <div class="item_list">
                     <div class="welcome_icon">
                        <i class="fa fa-list-alt"></i>
                     </div>
                     <h4>Tham gia sự kiện</h4>
                    <p>Dễ dàng tham gia các sự kiện tình nguyện. </p>
                    </div>
               </div>
            </div>
         </div>
         <!--End of col-md-3-->
         <div class="col-md-4">
            <div class="item">
               <div class="single_item">
                  <div class="item_list">
                     <div class="welcome_icon">
                        <i class="fa fa-hand-holding-usd"></i>
                     </div>
                     <h4>Bắt đầu quyên góp</h4>
                     <p>Chúng tôi luôn cố gắng minh bạch tài chính một cách tốt nhất có thể</p>
                  </div>
               </div>
            </div>
         </div>

      </div>
      <!--End of row-->
   </div>
</section>
<!--end of welcome section-->
<!--Start of volunteer-->
<section id="volunteer">
   <div class="container">
      <div class="row vol_area">
         <div class="col-md-8">
            <div class="volunteer_content">
               <h3>Trở thành <span>tình nguyện viên</span></h3>
               <p>Hãy chung tay cùng chúng tôi vì một cuộc sống và tương lai tốt đẹp hơn</p>
            </div>
         </div>
         <!--End of col-md-8-->
         <div class="col-md-3 col-md-offset-1">
            <div class="join_us">
               <a href="{{route('client.getRegister')}}" class="vol_cust_btn">tham gia ngay</a>
            </div>
         </div>
         <!--End of col-md-3-->
      </div>
      <!--End of row and vol_area-->
   </div>
   <!--End of container-->
</section>
<!--end of volunteer-->
<!--start of event-->
<section id="event">
    <div class="container">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             <div class="event_header text-center">
                <h2 data-aos="fade-down" data-aos-duration="2000">sự kiện mới nhất</h2>
             </div>
          </div>
       </div>
       <!--End of row-->
       <div class="row">
          <div class="col-md-8">
              @foreach ($events as $item )
             <div data-aos="fade-right" data-aos-duration="2000" class="row box-event">
                <div class="col-md-6 zero_mp">
                   <div class="event_item">
                      <div class="event_img">
                         <a  href="{{route('client.detailevent',$item->slug)}}" >
                            <img src="{{url('admin/photo/event/',$item->photo)}}" alt="">
                         </a>
                      </div>
                   </div>
                </div>
                <div class="col-md-6 zero_mp">
                   <div class="event_item">
                      <div class="event_text text-center">
                         <a href="{{route('client.detailevent',$item->slug)}}">
                            <h4>{{$item->title}}</h4>
                         </a>
                         <h6>{{date('d-m-Y h:i:s', strtotime($item->start_day))}}</h6>
                         <p style="-webkit-line-clamp: 4;overflow: hidden;text-overflow: ellipsis; -webkit-box-orient: vertical;display: -webkit-box;">{{$item->summary}}</p>
                         <a href="{{route('client.detailevent',$item->slug)}}" class="event_btn">đăng ký ngay</a>
                      </div>
                   </div>
                </div>
             </div>
             @endforeach
             <!--End of row-->
          </div>
          <!--End of col-md-8-->
          <div class="col-md-4">
              @foreach ($event_random as $item)

             <div class="event_news" data-aos="fade-up" data-aos-duration="2000">
                <div class="event_single_item fix">
                   <div class="event_news_img floatleft">
                      <img src="{{url('admin/photo/event/',$item->photo)}}" alt="">
                   </div>
                   <div class="event_news_text">
                      <a href="{{route('client.detailevent',$item->slug)}}">
                         <h4 style="-webkit-line-clamp: 1;overflow: hidden;text-overflow: ellipsis; -webkit-box-orient: vertical;display: -webkit-box;">{{$item->title}}</h4>
                      </a>
                      <p style="-webkit-line-clamp: 3;overflow: hidden;text-overflow: ellipsis; -webkit-box-orient: vertical;display: -webkit-box;">{{$item->summary}}</p>
                   </div>
                </div>
             </div>
             @endforeach
          </div>
          <!--End of col-md-4-->
       </div>
       <!--End of row-->
    </div>
    <!--End of container-->
 </section>
<!--end of event-->
<!--Start of counter-->
<section id="counter">
   <div class="counter_img_overlay">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="counter_header">
                  <h2 data-aos="fade-down" data-aos-duration="2000">THÀNH TỰU CỦA CHÚNG TÔI</h2>
                  <p data-aos="fade-left" data-aos-duration="2000">Những sự kiện thành công nhờ sự giúp đỡ của các tình nguyện viên cũng như các nhà tài trợ</p>
               </div>
            </div>
            <!--End of col-md-12-->
         </div>
         <!--End of row-->
         <div class="row list-achievement">
            <div class="col-md-3">
               <div class="counter_item text-center">
                  <div class="sigle_counter_item">
                     <!-- <img src="{{asset('home/img/event.png')}}" alt=""> -->
                     <i class="fas fa-calendar-alt"></i>
                     <div class="counter_text">
                        <span class="counter">{{$eventmore}}</span>
                        <p>Sự Kiện Đã Tổ Chức</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-3">
               <div class="counter_item text-center">
                  <div class="sigle_counter_item">
                     <!-- <img src="{{asset('home/img/hand.png')}}" alt=""> -->
                     <i class="fas fa-users"></i>
                     <div class="counter_text">
                        <span class="counter">{{$volunteers}}</span>
                        <p>Tình Nguyện Viên</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-3">
               <div class="counter_item text-center">
                  <div class="sigle_counter_item">
                     <!-- <img src="{{asset('home/img/tuhnder.png')}}" alt=""> -->
                     <i class="fas fa-hand-holding-heart"></i>
                     <div class="counter_text">
                        <span class="counter">{{$sponsors}}</span>
                        <p>Nhà Tài Trợ</p>
                     </div>
                  </div>
               </div>
            </div>
                <!-- <div class="col-md-3">
                <div class="counter_item text-center">
                    <div class="sigle_counter_item">
                        <img src="{{asset('home/img/cloud.png')}}" alt="">
                        <div class="counter_text">
                            <span class="counter">5412</span>
                            <p>Tình Nguyện Viên</p>
                        </div>
                    </div>
                </div>
                </div> -->
         </div>
         <!--End of row-->
      </div>
      <!--End of container-->
   </div>
</section>
<!--end of counter-->
<!--Start of blog-->
<section id="blog">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="latest_blog text-center">
               <h2 data-aos="fade-down" data-aos-duration="2000">tin tức mới nhất</h2>
            </div>
         </div>
      </div>
      <!--End of row-->
      <div class="row">
          @foreach ( $news as $item)
         <div class="col-md-4" data-aos="fade-up" data-aos-duration="2000">
            <div class="blog_news">
               <div class="single_blog_item">
                  <div class="blog_img">
                     <a href="{{route('news.detailnews',$item->slug)}}">
                        <img src="{{url('admin/photo/news/',$item->photo)}}" alt="">
                     </a>
                  </div>
                  <div class="blog_content">
                     <a href="{{route('news.detailnews',$item->slug)}}">
                        <h3 style="overflow: hidden;
                        line-height: 25px;
                        text-overflow: ellipsis;  -webkit-line-clamp: 2;
                        max-height: 50px;
                        display: -webkit-box;
                        -webkit-box-orient: vertical;margin-bottom: 10px;">{{$item->title}}</h3>
                     </a>
                     <div class="expert">
                        <div class="left-side text-left">
                           <p class="left_side">
                              <span class="clock"><i class="fa fa-clock-o"></i></span>
                              <span class="time">{{ date('d-m-Y H:i', strtotime($item->created_at)) }}</span>
                              <span class="admin"><i class="fa fa-user"></i> {{$item->poster}}</span>
                           </p>
                        </div>
                     </div>
                     <p class="blog_news_content" style="overflow: hidden;
                     text-overflow: ellipsis;
                     line-height: 25px;
                     -webkit-line-clamp: 4;
                     height: 100px;
                     display: -webkit-box;
                     -webkit-box-orient: vertical;
                     margin-bottom: 10px">{{$item->summary}}</p>
                     <a href="{{route('news.detailnews',$item->slug)}}" class="blog_link">đọc thêm</a>
                  </div>
               </div>
            </div>
         </div>
         @endforeach
         <!--End of col-md-4-->
        </div>
      <!--End of row-->
   </div>
   <!--End of container-->
</section>
<!-- end of blog-->

@endsection
