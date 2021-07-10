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
                                <li class="active"><a href="{{route('admin.profile')}}">Chỉnh sửa thông tin</a></li>
                                <li><a href="{{route('admin.showpassword')}}">Thay đổi mật khẩu</a></li>
                            </ul>
                            <div class="tab-content">

                                <!-- /.tab-pane -->
                                <div class="active tab-pane" id="settings">
                                    @if($employee)
                                        <form class="form-horizontal" role="form" method="post"
                                              action="{{route('updateemployee.profile')}}" enctype="multipart/form-data"
                                              id="emloyee-update">
                                            @csrf
                                            <input type="hidden" name="id" value="{{Auth::user()->id}}"/>
                                            <div class="form-group">
                                                <label for="nameemployee" class="col-sm-2 control-label">Họ và
                                                    tên</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="name" class="form-control" id="fullname"
                                                           placeholder="Họ và tên" value="{{$user->name}}">
                                                    <span class="form-message"></span>
                                                    @error('name')
                                                    <span class="error">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail" class="col-sm-2 control-label">Giới tính</label>
                                                <div class="col-sm-10">
                                                    <div style="display: flex; " class="box-gender">
                                                        <input value="male" type="radio" class="radio"
                                                               name="gender" {{ ($employee->gender=="male") ? "checked" : "" }}><span
                                                            style="line-height: 27px; margin-left: 3px; margin-right: 10px; ">Nam</span>
                                                        <input value="female" type="radio" class="radio"
                                                               name="gender" {{ ($employee->gender=="female") ? "checked" : "" }}><span
                                                            style="line-height: 27px; margin-left: 3px">Nữ</span>
                                                        <span class="form-message"></span>
                                                        @error('gender')
                                                        <span class="error">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Ngày Sinh</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" placeholder="" id="birthday" type="date"
                                                           name="birthday" value="{{$employee->birthday}}">
                                                    <span class="form-message"></span>
                                                    @error('birthday')
                                                    <span class="error">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <span class="form-message"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="emailemployee" class="col-sm-2 control-label">Email</label>

                                                <div class="col-sm-10">
                                                    <input type="text" name="email" class="form-control"
                                                           id="emailemployee" placeholder="Email"
                                                           value="{{ $user->email }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="addressemployee" class="col-sm-2 control-label">Địa
                                                    chỉ</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="address" class="form-control" id="address"
                                                           placeholder="Địa chỉ" value="{{$employee->address}}">
                                                    <span class="form-message"></span>
                                                    @error('address')
                                                    <span class="error">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSkills" class="col-sm-2 control-label">Số điện
                                                    thoại</label>

                                                <div class="col-sm-10">
                                                    <input type="text" name="phone" class="form-control" id="phone"
                                                           placeholder="Số điện thoại" value="{{$employee->phone}}">
                                                    <span class="form-message"></span>
                                                    @error('phone')
                                                    <span class="error">{{$message}}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-success"><i
                                                            class="far fa-check-circle"></i> Lưu
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                    @elseif ($admin)

                                        <form class="form-horizontal" role="form" method="post"
                                              action="{{route('updateadmin.profile')}}" enctype="multipart/form-data"
                                              id="admin-update">
                                            @csrf
                                            <input type="hidden" name="id" value="{{Auth::user()->id}}"/>
                                            <div class="form-group">
                                                <label for="inputName" class="col-sm-2 control-label">Họ và tên</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="name" class="form-control" id="fullname"
                                                           placeholder="Họ và tên" value="{{$user->name}}">
                                                    <span class="form-message"></span>
                                                    @error('name')
                                                    <span class="error">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputEmail" class="col-sm-2 control-label">Giới tính</label>
                                                <div class="col-sm-10">
                                                    <div style="display: flex; " class="box-gender">
                                                        <input value="male" type="radio" class="radio"
                                                               name="gender" {{ ($admin->gender=="male") ? "checked" : "" }}><span
                                                            style="line-height: 27px; margin-left: 3px; margin-right: 10px; ">Nam</span>
                                                        <input value="female" type="radio" class="radio"
                                                               name="gender" {{ ($admin->gender=="female") ? "checked" : "" }}><span
                                                            style="line-height: 27px; margin-left: 3px">Nữ</span>
                                                        <span class="form-message"></span>
                                                        @error('gender')
                                                        <span class="error">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Ngày Sinh</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" placeholder="" id="birthday" type="date"
                                                           name="birthday" value="{{$admin->birthday}}">
                                                    <span class="form-message"></span>
                                                    @error('birthday')
                                                    <span class="error">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputName" class="col-sm-2 control-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="email" class="form-control" id=""
                                                           placeholder="Email" value="{{ $user->email }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputExperience" class="col-sm-2 control-label">Địa
                                                    chỉ</label>

                                                <div class="col-sm-10">
                                                    <input type="text" name="address" class="form-control" id="address"
                                                           placeholder="Địa chỉ" value="{{$admin->address}}">
                                                    <span class="form-message"></span>
                                                </div>@error('address')
                                                <span class="error">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSkills" class="col-sm-2 control-label">Số điện
                                                    thoại</label>

                                                <div class="col-sm-10">
                                                    <input type="text" name="phone" class="form-control" id="phone"
                                                           placeholder="Số điện thoại" value="{{$admin->phone}}">
                                                    <span class="form-message"></span>
                                                    @error('phone')
                                                    <span class="error">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-success"><i
                                                            class="far fa-check-circle"></i> Lưu
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                    @endif
                                </div>
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
            form: '#admin-update',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#fullname', 'Vui lòng nhập trường này'),
                Validator.isRequired('#emaill'),
                Validator.isEmail('#emaill'),
                Validator.isRequired('#address'),
                Validator.isRequired('#phone'),
                Validator.isPhone('#phone'),
                Validator.isRequired('#birthday'),
                Validator.isRequired('input[name="gender"]'),
                //   Validator.isRequired('#password'),
                //  Validator.isRequired('#password_old'),
                //  Validator.minLength('#password_old',6),
                //  Validator.minLength('#password',6),
                //  Validator.isRequired('#password_confirm'),
            ]
        });
    </script>



    <script>
        Validator({
            form: '#emloyee-update',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#fullname', 'Vui lòng nhập trường này'),
                Validator.isRequired('#emaill'),
                Validator.isEmail('#emaill'),
                Validator.isRequired('#address'),
                Validator.isRequired('#phone'),
                Validator.isPhone('#phone'),
                Validator.isRequired('#birthday'),
                Validator.isRequired('input[name="gender"]'),

            ]
        });
    </script>
@endsection
