@extends('main.layouts.main')

@section('body')
<div class="wrapper">
    <div class="login">
        <form action="{{route('client.postLogin')}}" method="post" id="form-login">
            @csrf
            <h1 class="login-heading">Đăng Nhập</h1>
            {{-- <div class="signup-social">
                <a href="" class="signup-social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="" class="signup-social-icon"><i class="fab fa-google"></i></a>
            </div>
            <div class="signup-or">
                <span>Or</span>
            </div> --}}
            <div class="form-group">
                <label for="name">Email: </label>
                <input class="form-control" type="text" id="emaill" name="email"  placeholder="Email" value="{{old('email')}}"/>
                <span class="form-message"></span>
                @error('email')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Mật khẩu: </label>
                <input class="form-control" type="password" id="password" name="password"  placeholder="Mật khẩu" value="{{old('password')}}"/>
                <span class="form-message"></span>
                @error('password')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <button class="login-submit" type="submit" name="login-submit">Đăng Nhập</button>
            <p class="signup-already">
                <a href="{{route('client.email.get')}}" class="signup-link" >Quên mật khẩu</a>
            </p>
            <p class="signup-already">
                <span>Bạn Chưa Có Tài Khoản ?</span>
                <a href="{{route('client.getRegister')}}" class="signup-link" >Đăng Kí</a>
            </p>
        </form>

    </div>
</div>

@endsection

@section('jsblock')
<script>
    Validator({
     form: '#form-login',
     formGroupSelector: '.form-group',
     errorSelector: '.form-message',
     rules: [
       Validator.isRequired('#emaill'),
       Validator.isEmail('#emaill'),
       Validator.isRequired('#password'),
       Validator.minLength('#password',6),
   ]
   });


</script>

@endsection
