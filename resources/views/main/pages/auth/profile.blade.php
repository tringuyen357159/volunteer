@extends('main.layouts.main')


@section('body')
<div class="container" style="margin-bottom: 100px">
    <div class="warpper">
        <input class="radio-top" id="one" name="group" type="radio" checked>
        <input class="radio-top" id="two" name="group" type="radio">
        <div class="tabs">
            <a href="{{route('client.getProfile')}}" class="tab" id="one-tab" for="one">Thông Tin Cá Nhân</a>
            <a href="{{route('client.getPassword')}}" class="tab" for="two">Thay Đổi Mật Khẩu</a>
        </div>
        <div class="panels">
            <div class="panell" id="one-panel">
                <form class="box-form" role="form" method="post" action="{{route('client.updateProfile')}}" enctype="multipart/form-data" id="update-form">
                    @csrf
                    <div class="avatar-upload avatar">
                        <div class="avatar-edit">
                            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" onchange="readURL(this);" name="photo"/>
                            <label for="imageUpload"></label>
                        </div>
                        <div class="avatar-preview">
                            <img src="{{url('photo/user',$user->photo)}}" height="200" width="100%" id="preview" alt="photo" style="border-radius: 50%;height: 181px;
                            width: 181px;">
                        </div>
                        <span class="form-message"></span>
                        @error('photo')
                            <span class="error">{{$message}}</span>
                        @enderror
                    </div>
                    <input type="hidden"  name="id" value="{{$user->id}}"/>
                    <div class="form-groups">
                        <div class="form-group col-md-6 col-xs-12">
                            <label class="require">Tên Thành Viên :</label>
                            <input class="form-control" placeholder="" id="fullname" type="text" name="name" value="{{$user->name}}">
                            <span class="form-message"></span>
                            @error('name')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-xs-12">
                            <label class="require">Email :</label>
                            <input class="form-control" placeholder="" type="text" name="email" value="{{ $user->email }}" readonly>
                            @error('email')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-xs-12" >
                            <label for="">Giới tính: </label>
                            <div class="box-gender">
                                <input value="male" type="radio" class="radio"  name="gender" {{ ($volunteer->gender=="male") ? "checked" : "" }} ><span>Nam</span>
                                <input value="female" type="radio" class="radio"  name="gender" {{ ($volunteer->gender=="female") ? "checked" : "" }} ><span>Nữ</span>
                            </div>
                            <span class="form-message"></span>
                            @error('gender')
                            <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-xs-12">
                            <label class="require">Ngày Sinh :</label>
                            <input class="form-control" placeholder="" id="birthday" type="date"  name="birthday" value="{{$volunteer->birthday}}" >
                            <span class="form-message"></span>
                            @error('birthday')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-xs-12">
                            <label class="require">Số Điện Thoại :</label>
                            <input class="form-control" placeholder="" id="phone" type="text" name="phone" value="{{ $volunteer->phone }}">
                            <span class="form-message"></span>
                            @error('phone')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-xs-12">
                            <label class="require">Địa chỉ :</label>
                            <input class="form-control" placeholder="" id="address" type="text" name="address" value="{{ $volunteer->address }}">
                            <span class="form-message"></span>
                            @error('address')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-xs-12">
                        <div class="btn-set">
                            <button class="btn-up" type="submit">
                                <i class="far fa-check-circle"></i>
                                Lưu
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            {{-- <div class="panell" id="two-panel">

            </div> --}}
        </div>
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
     form: '#update-form',
     formGroupSelector: '.form-group',
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

