<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">DTU</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">Tình Nguyện DTU</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown notifications-menu">
                    <a href="{{route('home')}}" class="" target="_blank">
                        <i class="fas fa-globe"></i>
                      <span class="">Trang chủ</span>
                    </a>

                  </li>
                <!-- Messages: style can be found in dropdown.less-->

                <!-- Notifications: style can be found in dropdown.less -->
                @php
                    $noty = auth()->user()->unreadNotifications
                    ->count();
                    $notifications = auth()->user()->unreadNotifications;
                    // dd($notifications);
                    $user = Auth::user() ;


                @endphp
                @if ($user->id==8)
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="far fa-bell"></i>
                        <span class="label label-warning">{{$noty}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Bạn có {{$noty}} thông báo</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                @foreach ($notifications as $notification)
                                    <li>
                                        <a href="{{route('mark.Notification', $notification->id)}}">
                                            Tình nguyện viên  <span class="text-warning">{{ $notification->data["name"] }}</span> vừa tham gia


                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="footer"><a href="{{route('markAll.Notification')}}" id="mark-all">
                                Đánh dấu đọc tất cả
                            </a></li>
                    </ul>
                </li>
                @else

                @endif

                @php
                    $user = Auth::user() ;
                @endphp
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{url('photo/user',$user->photo)}}" class="user-image" alt="">
                        <span class="hidden-xs"> {{$user->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!--  -->
                        <li class="user-header">
                            <img src="{{url('photo/user',$user->photo)}}" class="img-circle" alt="">
                            <p>
                                {{$user->name}}
                                <small>{{$user->created_at}}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{route('admin.profile')}}" class="btn btn-default btn-flat">Thông tin</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{route('admin.logout')}}" class="btn btn-default btn-flat"
                                   onclick="return confirm('Bạn có chắc muốn đăng xuất hay không?');">Đăng xuất</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
