@extends('main.layouts.main')
@section('title')
    Sự Kiện
@endsection
@section('body')
<section id="event">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="event_header text-center" style="padding: 20px 0px">
               <h2 data-aos="fade-down" data-aos-duration="2000">Sự kiện</h2>
            </div>
         </div>
      </div>
      <!--End of row-->
      <div class="row">
         <div class="col-md-8" data-aos="fade-right" data-aos-duration="2000">
            @foreach ($events as $item)
            <div class="row box-event" style="margin-bottom: 10px">
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
                     <div class="event_text" style="">
                        <a href="{{route('client.detailevent',$item->slug)}}">
                           <h4 style="overflow: hidden;
                              line-height: 25px;
                              text-overflow: ellipsis;  -webkit-line-clamp: 3;
                              max-height: 75px;
                              display: -webkit-box;
                              -webkit-box-orient: vertical;">{{$item->title}}</h4>
                        </a>
                        <h6>{{date('d-m-Y H:i', strtotime($item->created_at)) }}</h6>
                        <p style="overflow: hidden;
                           text-overflow: ellipsis;
                           line-height: 25px;
                           -webkit-line-clamp: 4;
                           height: 100px;
                           display: -webkit-box;
                           -webkit-box-orient: vertical;
                           margin-bottom: 10px">{{$item->summary}}</p>
                        <div class="text-center">
                           <a href="{{route('client.detailevent',$item->slug)}}" class="event_btn" >Đăng ký ngay</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @endforeach
            <!--End of row-->
            <div>{{$events->links()}}</div>
         </div>
         <!--End of col-md-8-->
         <div class="col-md-4" data-aos="fade-left" data-aos-duration="2000">
            <a href="">
               <h3 class="mb-4" style="font-family:'Roboto Slab'; font-weight: 700; color: #0d6efd; text-transform: uppercase; margin-bottom: 10px">
                  Môi trường
               </h3>
            </a>
            @foreach ($events_mt as $item)
            <div class="event_news">
               <div class="event_single_item fix">
                  <div class="event_news_img floatleft">
                    <a  href="{{route('client.detailevent',$item->slug)}}" >
                        <img src="{{url('admin/photo/event/',$item->photo)}}" alt="">
                    </a>
                  </div>
                  <div class="event_news_text">
                     <a href="{{route('client.detailevent',$item->slug)}}">
                        <h4 style="overflow: hidden;
                           white-space: nowrap;
                           text-overflow: ellipsis;">{{$item->title}}</h4>
                     </a>
                     <p style="overflow: hidden;
                        text-overflow: ellipsis;
                        -webkit-line-clamp: 3;
                        display: -webkit-box;
                        -webkit-box-orient: vertical;">{{$item->summary}}</p>
                  </div>
               </div>
            </div>
            @endforeach
            <a href="">
               <h3 class="mb-4" style="font-family:'Roboto Slab'; font-weight: 700; color: #0d6efd; text-transform: uppercase; margin-bottom: 10px">
                  Thể thao
               </h3>
            </a>
            @foreach ($events_tt as $item)
            <div class="event_news">
               <div class="event_single_item fix">
                  <div class="event_news_img floatleft">
                     <a  href="{{route('client.detailevent',$item->slug)}}" >
                        <img src="{{url('admin/photo/event/',$item->photo)}}" alt="">
                    </a>
                  </div>
                  <div class="event_news_text">
                     <a href="{{route('client.detailevent',$item->slug)}}">
                        <h4 style="overflow: hidden;
                           white-space: nowrap;
                           text-overflow: ellipsis;">{{$item->title}}</h4>
                     </a>
                     <p style="overflow: hidden;
                        text-overflow: ellipsis;
                        -webkit-line-clamp: 3;
                        display: -webkit-box;
                        -webkit-box-orient: vertical;">{{$item->summary}}</p>
                  </div>
               </div>
            </div>
            @endforeach
            <a href="">
               <h3 class="mb-4" style="font-family:'Roboto Slab'; font-weight: 700; color: #0d6efd; text-transform: uppercase; margin-bottom: 10px">
                  Quyên tặng
               </h3>
            </a>
            @foreach ($events_qt as $item)
            <div class="event_news">
               <div class="event_single_item fix">
                  <div class="event_news_img floatleft">
                    <a  href="{{route('client.detailevent',$item->slug)}}" >
                        <img src="{{url('admin/photo/event/',$item->photo)}}" alt="">
                    </a>
                  </div>
                  <div class="event_news_text">
                     <a href="{{route('client.detailevent',$item->slug)}}">
                        <h4 style="overflow: hidden;
                           white-space: nowrap;
                           text-overflow: ellipsis;">{{$item->title}}</h4>
                     </a>
                     <p style="overflow: hidden;
                        text-overflow: ellipsis;
                        -webkit-line-clamp: 3;
                        display: -webkit-box;
                        -webkit-box-orient: vertical;">{{$item->summary}}</p>
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
@endsection
