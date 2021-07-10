<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="">
                <a href="{{route('dashboard')}}">
                    <i class="fas fa-tachometer-alt"style="margin-right: 3px"></i>
                    <span>Thống kê</span>
                </a>
            </li>
            <li>
                <a href="{{route('banner.index')}}">
                    <i class="far fa-images" style="margin-right: 3px"></i>
                    <span>Banner</span>
                </a>
            </li>

            <li >
                <a href="{{route('volunteer.show')}}">
                    <i class="fas fa-people-carry" style="margin-right: 3px"></i>
                    <span>Tình nguyện viên</span>
                </a>
            </li>
            <li >
                <a href="{{route('employee.list')}}">
                    <i class="fas fa-users-cog" style="margin-right: 3px"></i>
                    <span>Nhân viên</span>
                </a>
            </li>
            <li>
                <a href="{{route('news.show')}}" class="treeview">
                    <i class="far fa-newspaper" style="margin-right: 3px"></i>
                    <span>Tin tức</span>
                </a>
            </li>
            {{-- <li >
                <a href="{{ route('event.list')}}">
                    <i class="far fa-calendar-alt" style="margin-right: 3px"></i>
                    <span>Sự kiện</span>
                </a>
            </li> --}}
            <li class="treeview">
                <a href="#">
                    <i class="far fa-calendar-alt" style="margin-right: 3px"></i>
                    <span>Quản lý sự kiện</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('event.list')}}"><i class="fas fa-list-alt"></i> Sự kiện </a>
                    </li>
                    <li><a href="{{ route('event.list.wait.agree')}}"><i class="fas fa-user-edit"></i> Sự kiện chờ phê duyệt</a>
                    </li>
                    <li><a href="{{ route('event.list.agree')}}"><i class="fas fa-clipboard-check"></i> Sự kiện đã phê duyệt</a></li>
                </ul>
            </li>
            <li >
                <a href="{{ route('tool.list')}}">
                    <i class="fas fa-toolbox" style="margin-right: 3px"></i>
                    <span>Dụng cụ</span>
                </a>
            </li>
            <li >
                <a href="{{ route('eventregister.show')}}">
                    <i class="fas fa-calendar-check" style="margin-right: 3px"></i>
                    <span>Sự kiện đăng ký</span>
                </a>
            </li>
            <li >
                <a href="{{ route('sponsor.list')}}">
                    <i class="fas fa-house-user" style="margin-right: 3px"></i>
                    <span>Nhà tài trợ</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fas fa-shield-alt" style="margin-right: 3px"></i>
                    <span>Quản lý phân quyền</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('role.index')}}"><i class="fas fa-user-tag"></i> Nhóm quyền và chức năng</a>
                    </li>
                    <li><a href="{{route('user.index')}}"><i class="fas fa-user"></i> Quyền nhân viên</a></li>
                </ul>
            </li>
            <li >
                <a href="{{ route('feedback.show')}}">
                    <i class="fas fa-toolbox" style="margin-right: 3px"></i>
                    <span>Phản hồi</span>
                </a>
            </li>
            <li >
                <a href="{{ route('comment.list')}}">
                    <i class="far fa-comments" style="margin-right: 3px"></i>
                    <span>Bình Luận</span>
                </a>
            </li>
            <li >
                <a href="{{ route('statistic.list')}}">
                    <i class="fas fa-toolbox" style="margin-right: 3px"></i>
                    <span>Thống kê tài chính</span>
                </a>
            </li>
            {{-- <li >
                <a href="{{ route('chat.show')}}">
                    <i class="fas fa-toolbox" style="margin-right: 3px"></i>
                    <span>Chat</span>
                </a>
            </li> --}}
            <li >
                <a href="{{route('deatail.show')}}">
                    <i class="fas fa-money-check-alt" style="margin-right: 3px"></i>
                    <span>Quản lý chi tiêu</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->

</aside>
