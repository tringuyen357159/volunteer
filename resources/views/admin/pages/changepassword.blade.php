@extends('admin.layouts.master')
@section('title')
   Thông tin cá nhân
@endsection
@section('content_head')
    <section class="content-header">
        <h1>
            ThÔNG TIN CÁ NHÂN
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Thông tin cá nhân</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="container">
        <div class="">
            <!-- Main content -->
            <section class="content">

                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="box box-primary">
                            <div class="box-body box-profile">

                                <img class="profile-user-img img-responsive img-circle"
                                     src="{{url('photo/user/',$user->photo)}}" alt="User profile picture">

                                <h3 class="profile-username text-center">{{$user->name}}</h3>
                                @if($employee)
                                    <p class="text-muted text-center">Nhân viên</p>
                                @elseif ($admin)
                                    <p class="text-muted text-center">Quản trị viên</p>
                                @endif
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->

                    </div>
                    <!-- /.col -->
                    <div class="col-md-8">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li><a href="{{route('admin.profile')}}">Chỉnh sửa thông tin</a></li>
                                <li class="active"><a href="{{route('admin.showpassword')}}" data-toggle="tab">Thay đổi
                                        mật khẩu</a></li>
                            </ul>
                            <div class="tab-content">
                                <!-- /.tab-pane -->
                                <div class="active tab-pane" id="activity">
                                    <!-- Post -->
                                    <div class="post">
                                        <div class="user-block">
                                            <form class="box-form" role="form" method="post"
                                                  action="{{route('updatepassword.profile')}}"
                                                  enctype="multipart/form-data" id="update-pass" style="display: flex;
                                                  flex-wrap: wrap;">
                                                @csrf
                                                <div class="form-group col-md-6 col-xs-12 password"
                                                     style="position: relative;">
                                                    <label class="require">Mật khẩu cũ :</label>
                                                    <input class="form-control" id="password_old" placeholder=""
                                                           type="password" name="password_old" value="">
                                                    <a href="javascript:;void(0);"
                                                       style="position: absolute;top: 32px;right: 6%;"><i
                                                            class="fa fa-eye"></i></a>
                                                    <span class="form-message"></span>
                                                    @error('password_old')
                                                    <span class="error">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6 col-xs-12 password"
                                                     style="position: relative">
                                                    <label class="require">Mật khẩu mới :</label>
                                                    <input class="form-control" id="password" placeholder=""
                                                           type="password" name="password" value="">
                                                    <a href="javascript:;void(0);"
                                                       style="position: absolute;top: 32px;right: 6%;"><i
                                                            class="fa fa-eye"></i></a>
                                                    <span class="form-message"></span>
                                                    @error('password')
                                                    <span class="error">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6 col-xs-12 password"
                                                     style="position: relative">
                                                    <label class="require">Nhập lại mật khẩu mới :</label>
                                                    <input class="form-control" id="password_confirm" placeholder=""
                                                           type="password" name="password_confirm" value="">
                                                    <a href="javascript:;void(0);"
                                                       style="position: absolute;top: 32px;right: 6%;"><i
                                                            class="fa fa-eye"></i></a>
                                                    <span class="form-message"></span>
                                                    @error('password_confirm')
                                                    <span class="error">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-xs-12">
                                                    <div class="btn-set">
                                                        <button class="btn btn-success" type="submit">
                                                            <i class="far fa-check-circle"></i>
                                                            Cập nhật
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection

@section('jsblock')
    <script>
        $(function () {
            $(".form-group a").click(function () {
                let $this = $(this);

                if ($this.hasClass('active')) {
                    $this.parents('.form-group').find('input').attr('type', 'password');
                    $this.removeClass('active');
                } else {
                    $this.parents('.form-group').find('input').attr('type', 'text');
                    $this.addClass('active');
                }
            });
        });
    </script>
    <script>
        Validator({
            form: '#update-pass',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#password'),
                Validator.isRequired('#password_old'),
                Validator.minLength('#password_old', 6),
                Validator.minLength('#password', 6),
                Validator.isRequired('#password_confirm'),
            ]
        });
    </script>
@endsection
