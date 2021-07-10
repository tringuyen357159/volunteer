@extends('main.layouts.main')

@section('body')
<div class="wrapper bg-img">
    <div class="signup">
            <form action="{{route('client.postRegister')}}" method="post" enctype="multipart/form-data" role="form" id="form-register">
                @csrf
                <h1 class="signup-heading">Đăng Kí</h1>
                {{-- <div class="signup-social">
                    <a href="" class="signup-social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="" class="signup-social-icon"><i class="fab fa-google"></i></a>
                </div> --}}
                {{-- <div class="signup-or">
                    <span>Or</span>
                </div> --}}
                <div class="contents-signup">
                    <div class="contents-left-signup ">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type="file" accept="image/*" id="imageUpload"  name="photo" onchange="readURL(this);" />
                                <label for="imageUpload"></label>
                            </div>
                            <div class="avatar-preview">
                                <div >
                                    <img src="http://placehold.it/180" height="200" width="100%" id="preview" alt="photo/event" style="border-radius: 50%;height: 288px;
                                    width: 288px;">
                                </div>
                            </div>
                            <span class="form-message"></span>
                            @error('photo')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="contents-right-signup">
                        <div class="content-signup">
                            <label for="name">Name: </label>
                            <input class="form-control" type="text" id="fullname" name="name" placeholder="Tên" value="{{old('name')}}"/>
                            <span class="form-message"></span>
                            @error('name')
                            <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="content-signup" style="display: flex;">
                            <label for="">Giới tính: </label>
                           <input  type="radio" class="radio" name="gender" value="male" style="margin-left: 15px;margin-right: 5px;"><span>Nam</span>
                           <input type="radio" class="radio" name="gender" value="female" style="margin-left: 15px;margin-right: 5px;"><span>Nữ</span>
                           <span class="form-message"></span>
                           @error('gender')
                           <span class="error">{{$message}}</span>
                           @enderror
                        </div>
                        <div class="content-signup">
                            <label for="name">Ngày sinh: </label>
                            <input class="form-control"  type="date" id="birthday" name="birthday"  placeholder="Ngày sinh (MM/DD/YYY)" value="{{old('birthday')}}"/>
                            <span class="form-message"></span>
                            @error('birthday')
                            <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="content-signup">
                            <label for="name">Email: </label>
                            <input class="form-control" type="text" id="emaill" name="email"  placeholder="Email" value="{{old('email')}}"/>
                            <span class="form-message"></span>
                            @error('email')
                            <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="content-signup">
                            <label for="name">Mật khẩu: </label>
                            <input class="form-control" type="password" id="password" name="password"  placeholder="Mật khẩu" value="{{old('password')}}"/>
                            <span class="form-message"></span>
                            @error('password')
                            <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="content-signup">
                            <label for="name">Địa chỉ: </label>
                            <input class="form-control" type="text" id="address" name="address"  placeholder="Địa chỉ" value="{{old('address')}}"/>
                            <span class="form-message"></span>
                            @error('address')
                            <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="content-signup">
                            <label for="name">SĐT: </label>
                            <input class="form-control" type="text" id="phone" name="phone"  placeholder="Số điện thoại" value="{{old('phone')}}"/>
                            <span class="form-message"></span>
                            @error('phone')
                            <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="content-signup">
                            <button class="signup-submit" name="signup-submit" type="submit">Đăng kí</button>
                            <p class="signup-already">
                                <span>Bạn Đã Có Tài Khoản ?</span>
                                <a href="{{route('client.getLogin')}}" class="signup-link">Đăng Nhập</a>
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
</div>


@endsection
@section('jsblock')
<script>
    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
    <script>
         Validator({
          form: '#form-register',
          formGroupSelector: '.content-signup',
          errorSelector: '.form-message',
          rules: [
            Validator.isRequired('#fullname', 'Vui lòng nhập trường này'),
            Validator.isRequired('#emaill'),
            Validator.isEmail('#emaill'),
            Validator.isRequired('#password'),
            Validator.minLength('#password',6),
            Validator.isRequired('#address'),
            Validator.isRequired('#phone'),
            Validator.isPhone('#phone'),
            Validator.isRequired('#birthday'),
            Validator.isRequired('input[name="gender"]'),
        ]
        });
    </script>
@endsection

