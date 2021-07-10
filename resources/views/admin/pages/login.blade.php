<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Đăng nhập admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin/dist/css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('admin/plugins/iCheck/square/blue.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js')}}"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background: ">
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b>Tình Nguyện Duy Tân</a>
    </div>
    <div class="login-box-body" style="border-radius: 1rem">
        <p class="login-box-msg">Vui lòng đăng nhập để tiếp tục</p>

        <form action="{{route('admin.login')}}" method="post">
            @csrf
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                <span class="error-message text text-danger">{{ $errors->first('email') }}</span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password"
                       value="{{old('password')}}">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <span class="error-message text text-danger">{{ $errors->first('password') }}</span>
                <span class="error-message text text-danger">{{ session()->get('error') }}</span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    {{-- <div class="checkbox icheck">
                      <label>
                        <input type="checkbox"> Ghi nhớ
                      </label>
                    </div> --}}
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
                </div>

            </div>
        </form>


        <!-- /.social-auth-links -->

        <a href="{{route('email.get')}}">Quên mật khẩu?</a><br>
        {{--<a href="register.html" class="text-center">Register a new membership</a> --}}

    </div>

</div>


<!-- jQuery 3 -->
<script src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js')}}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
</body>
</html>
