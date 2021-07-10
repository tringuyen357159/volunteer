<section id="header">
    @php
    $user =DB::table('users')
    ->where('email', session()->get('user'))
    ->first();
    @endphp
    <script
    src="https://code.jquery.com/jquery-3.6.0.slim.js"
    integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY="
    crossorigin="anonymous"></script>
    <style>


/* *{
  margin: 0;
  padding: 0;
  text-decoration: none;
  list-style: none;
  box-sizing: border-box;
  font-family: 'Montserrat';
} */

/* body{
  background: #dfecff;
  color: #7f8db0;
} */

a{
   color: #7f8db0;
}


/* .navbarr{
  background: #fff;
  width: 100%;
  height: 60px;
  padding: 0 25px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: 0 1px 2px rgba(0,0,0,0.1);
} */

.navbarrr .navbarr_left .logo a{
   font-family: 'Trade Winds';
   font-size: 20px;
}

.navbarr .navbarr_right{
   display: flex;
}

.navbarr .navbarr_right img{
  width: 35px;
  height: 35px;
}

.navbarr .navbarr_right .icon_wrap{
  cursor: pointer;
}

.navbarr .navbarr_right .notifications{
  margin-right: 25px;
}

.navbarr .navbarr_right .notifications .icon_wrap{
  font-size: 28px;
}

.navbarr .navbarr_right .profile,
.navbarr .navbarr_right .notifications{
  position: relative;
}

.navbarr .profile .profile_dd,
.notification_dd{
  position: absolute;
  top: 48px;
  right: -15px;
  user-select: none;
  background: #fff;
  border: 1px solid #c7d8e2;
  width: 350px;
  height: auto;
  display: none;
  border-radius: 3px;
  box-shadow: 10px 10px 35px rgba(0,0,0,0.125),
              -10px -10px 35px rgba(0,0,0,0.125);
    z-index: 10000;
}

.navbarr .profile .profile_dd:before,
.notification_dd:before{
    content: "";
    position: absolute;
    top: -20px;
    right: 15px;
    border: 10px solid;
    border-color: transparent transparent #fff transparent;
}

.notification_dd li {
    border-bottom: 1px solid #f1f2f4;
    padding: 10px 20px;
    display: flex;
    align-items: center;
}

.notification_dd li .notify_icon{
  display: flex;
}

.notification_dd li .notify_icon .icon{
  display: inline-block;
  background: url('https://i.imgur.com/MVJNkqW.png') no-repeat 0 0;
	width: 40px;
	height: 42px;
}

.notification_dd li.baskin_robbins .notify_icon .icon{
  background-position: 0 -43px;
}

.notification_dd li.mcd .notify_icon .icon{
  background-position: 0 -86px;
}

.notification_dd li.pizzahut .notify_icon .icon{
  background-position: 0 -129px;
}

.notification_dd li.kfc .notify_icon .icon{
  background-position: 0 -178px;
}

.notification_dd li .notify_data{
  margin: 0 15px;
  width: 185px;
}

.notification_dd li .notify_data .title{
  color: #000;
  font-weight: 600;
}

.notification_dd li .notify_data .sub_title{
  font-size: 14px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  margin-top: 5px;
}

.notification_dd li .notify_status p{
  font-size: 12px;
}

.notification_dd li.success .notify_status p{
  color: #47da89;
}

.notification_dd li.failed .notify_status p{
  color: #fb0001;
}

.notification_dd li.show_all{
  padding: 20px;
  display: flex;
  justify-content: center;
}

.notification_dd li.show_all p{
  font-weight: 700;
  color: #4DA91C;
  cursor: pointer;
}

.notification_dd li.show_all p:hover{
  text-decoration: underline;
}

.navbarr .navbarr_right .profile .icon_wrap{
  display: flex;
  align-items: center;
}

.navbarr .navbarr_right .profile .name{
  display: inline-block;
  margin: 0 10px;
  color: white;
}

.navbarr .navbarr_right .icon_wrap:hover,
.navbarr .navbarr_right .profile.active .icon_wrap,
.navbarr .navbarr_right .notifications.active .icon_wrap{
  color: #4DA91C;
}

.navbarr .profile .profile_dd{
  width: 225px;
}
.navbarr .profile .profile_dd:before{
  rigth: 10px;
}

.navbarr .profile .profile_dd ul li {
    border-bottom: 1px solid #f1f2f4;
}

.navbarr .profile .profile_dd ul li  a{
    display: block;
    padding: 15px 20px;
    text-align: left;
    color: #646464;
}

.navbarr .profile .profile_dd ul li  a .picon{
  display: inline-block;
  width: 30px;
}

.navbarr .profile .profile_dd ul li  a:hover{
  color: #4DA91C;
  background: #f0f5ff;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}

.navbarr .profile .profile_dd ul li.profile_li a:hover {
    background: transparent;
    cursor: default;
    color: #7f8db0;
}



.navbarr .profile .profile_dd ul li .btn:hover{
  background: #4DA91C;
}

.navbarr .profile.active .profile_dd,
.navbarr .notifications.active .notification_dd{
  display: block;
}

    </style>
    <div class="header-area">
        <div class="top_header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 zero_mp">
                        <div class="address">
                            <i class="fa fa-home floatleft" style="color: #f1ae44;"></i>
                            <p style="color: white">Thanh Khê-Đà Nẵng</p>
                        </div>
                    </div>
                    <!--End of col-md-4-->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6  zero_mp">
                        <div class="phone">
                            <i class="fa fa-phone floatleft" style="color: #f1ae44;"></i>
                            <a href="tel: 0783875742" style="font-size: 13px;
                            padding-top: 2px;
                            color: white;
                            font-family: 'Open Sans', sans-serif;"> 0783875742</a>
                        </div>
                    </div>
                    <!--End of col-md-4-->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 d-flex justify-content-center zero_mp logged">
                        <div class="social_icon text-right">
                            @if(Session::get('user'))
                            <!-- <a href="{{route('client.getProfile')}}">Hồ sơ</a>
                            <a href="{{route('client.eventmanagement')}}">Quản lý sự kiện</a>
                            <a href="{{route('client.logout')}}">Đăng xuất</a> -->
                            <div class=".dropdown">
                                <div class="navbarr">
                                  <div class="navbarr_right" style="margin-bottom: 10px;">
                                    <div class="profile">
                                      <div class="icon_wrap">
                                        <img style="border-radius: 50%" src="{{url('photo/user',$user->photo)}}" >
                                        <span class="name">{{$user->name}}</span>
                                        <i class="fas fa-chevron-down"></i>
                                      </div>
                                      <div class="profile_dd">
                                        <ul class="profile_ul">
                                          <li><a class="" href="{{route('client.getProfile')}}"><span class="picon"><i style="font-size: 16px" class="fas fa-file-alt"></i></span>Thông tin cá nhân</a></li>
                                          <li><a class="settings" href="{{route('client.eventmanagement')}}"><span class="picon"><i style="font-size: 16px" class="far fa-calendar-check"></i></span>Quản lý sự kiện</a></li>
                                          <li><a class="logout" href="{{route('client.logout')}}"><span class="picon"><i style="font-size: 16px" class="fas fa-sign-out-alt"></i></span>Đăng xuất</a></li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            @else
                            <a href="{{route('client.getLogin')}}" class="not-logger">Đăng nhập </a>
                            <a href="{{route('client.getRegister')}}" class="not-logger">Đăng ký</a>
                            @endif
                        </div>
                    </div>
                    <!--End of col-md-4-->
                </div>
            <!--End of row-->
            </div>
            <!--End of container-->
        </div>
        <!--End of top header-->
        <div class="header_menu text-center" data-spy="affix" data-offset-top="50" id="nav">
            <div class="container">
                <nav class="navbar navbar-default zero_mp ">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand custom_navbar-brand" href="/"><img src="{{asset('home/img/logo.png')}}" alt=""></a>
                    </div>
                    <!--End of navbar-header-->
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse zero_mp" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right main_menu">
                            <li class="active"><a href="/">Trang Chủ <span class="sr-only">(current)</span></a></li>
                            <li><a href="/welcome">Giới Thiệu</a></li>
                            <li><a href="{{route('client.event')}}">Sự Kiện</a></li>
                            <li><a href="{{route('news.list')}}">Tin Tức</a></li>
                            <li><a href="{{route('client.donate')}}">Tài trợ</a></li>
                            <li><a href="/contact">Liên Hệ</a></li>
                        </ul>
                    </div>
                    <!-- /.dropdown-collapse -->
                </nav>
                <!--End of nav-->
            </div>
            <!--End of container-->
        </div>
        <!--End of header menu-->
    </div>
    <!--end of header area-->
</section>
<script>
  $(".profile .icon_wrap").click(function(){
  $(this).parent().toggleClass("active");
  $(".notifications").removeClass("active");
});

$(".notifications .icon_wrap").click(function(){
  $(this).parent().toggleClass("active");
   $(".profile").removeClass("active");
});

$(".show_all .link").click(function(){
  $(".notifications").removeClass("active");
  $(".popup").show();
});

$(".close, .shadow").click(function(){
  $(".popup").hide();
});

$(".navbar-toggle").click(function(){
    var element = document.getElementById("bs-example-navbar-collapse-1");
    element.classList.toggle("in");
});
</script>
