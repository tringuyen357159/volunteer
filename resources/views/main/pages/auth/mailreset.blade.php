@extends('main.layouts.main')

@section('body')
<div class="wrapper">
    <div class="login">
        <form action="{{route('client.email.post')}}" method="post"   >
            @csrf
            <h1 class="login-heading">Email lấy lại mật khẩu</h1>
            <div class="form-group">
                <label for="name">Email: </label>
                <input class="form-control" type="text" id="emaill" name="email"  placeholder="Email" value="{{old('email')}}"/>
                <span class="form-message"></span>
                @error('email')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <button class="login-submit" type="submit" name="login-submit"> Gửi</button>
        </form>
    </div>
</div>

@endsection

@section('jsblock')

@endsection
