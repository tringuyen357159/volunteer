@extends('main.layouts.main')
@section('body')
<section id="event" style="padding: 20px 0px">
    <div class="container">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             <div class="event_header text-center" style="padding: 20px 0px">
                <h2>Tin tức</h2>
             </div>
          </div>
       </div>
       <!--End of row-->
       <div class="row">
          <div class="col-md-8">
            @foreach ($news as $item)
             <div class="row" style="margin-bottom: 10px">
                <div class="col-md-6 zero_mp">
                   <div class="event_item">
                      <div class="event_img">
                         <img src="{{url('admin/photo/news/',$item->photo)}}" alt="">
                      </div>
                   </div>
                </div>
                <div class="col-md-6 zero_mp">
                   <div class="event_item">
                    <div class="event_text" style="">
                        <a href="{{route('news.detailnews',$item->slug)}}">
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
                        <a href="{{route('news.detailnews',$item->slug)}}" class="event_btn" >đọc thêm</a>
                       </div>
                     </div>
                   </div>
                </div>
             </div>
             @endforeach
             <!--End of row-->
            </div>
          <!--End of col-md-8-->
          <div class="col-md-4">
            <a href="{{route('news.vlt')}}">
            <h3 class="mb-4" style="font-family:'Roboto Slab'; font-weight: 700; color: #0d6efd; text-transform: uppercase; margin-bottom: 10px">
                Tình nguyện
              </h3>
            </a>
            @foreach ($news_volunteering as $item)
            <div class="event_news">
            <div class="event_single_item fix">
               <div class="event_news_img floatleft">
                  <img src="{{url('admin/photo/news/',$item->photo)}}" alt="">
               </div>
               <div class="event_news_text">
                  <a href="{{route('news.detailnews',$item->slug)}}">
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
         <a href="{{route('news.org')}}">
         <h3 class="mb-4" style="font-family:'Roboto Slab'; font-weight: 700; color: #0d6efd; text-transform: uppercase; margin-bottom: 10px">
            Tổ chức
          </h3>
         </a>
          @foreach ($news_organisation as $item)
            <div class="event_news">
                <div class="event_single_item fix">
                   <div class="event_news_img floatleft">
                      <img src="{{url('admin/photo/news/',$item->photo)}}" alt="">
                   </div>
                   <div class="event_news_text">
                      <a href="{{route('news.detailnews',$item->slug)}}">
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
             <a href="{{route('news.blog')}}">
             <h3 class="mb-4" style="font-family:'Roboto Slab'; font-weight: 700; color: #0d6efd; text-transform: uppercase; margin-bottom: 10px">
                Blog
              </h3>
            </a>
              @foreach ($news_our_blog as $item)
             <div class="event_news">
            <div class="event_single_item fix">
               <div class="event_news_img floatleft">
                  <img src="{{url('admin/photo/news/',$item->photo)}}" alt="">
               </div>
               <div class="event_news_text">
                  <a href="{{route('news.detailnews',$item->slug)}}">
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
 <!--end of event-->
 @endsection
