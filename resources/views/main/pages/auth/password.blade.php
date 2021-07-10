@extends('main.layouts.main')


@section('body')

<div class="container" style="margin-bottom: 100px">
    <div class="warpper">
        <input class="radio-top" id="one" name="group" type="radio" checked>
        <input class="radio-top" id="two" name="group" type="radio">
        <div class="tabs">
            <a href="{{route('client.getProfile')}}" class="tab" for="one">Thông Tin Cá Nhân</a>
            <a href="{{route('client.getPassword')}}" class="tab" id="one-tab" for="two">Thay Đổi Mật Khẩu</a>
        </div>
        <div class="panels changepass">
            <div class="panell" id="one-panel">
                <form class="box-form" role="form" method="post" action="{{route('client.updatePassword')}}" enctype="multipart/form-data" id="password-form">
                    @csrf
                        <div class="form-group col-md-6 col-xs-12 password" style="position: relative">
                            <label class="require">Mật khẩu cũ :</label>
                            <input class="form-control" id="password_old" placeholder="" type="password" name="password_old" value="">
                            <a href="javascript:;void(0);" style="position: absolute;top: 32px;right: 6%;"><i class="fa fa-eye"></i></a>
                            <span class="form-message"></span>
                            @error('password_old')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-xs-12 password" style="position: relative">
                            <label class="require">Mật khẩu mới :</label>
                            <input class="form-control" id="password" placeholder="" type="password" name="password" value="">
                            <a href="javascript:;void(0);" style="position: absolute;top: 32px;right: 6%;"><i class="fa fa-eye"></i></a>
                            <span class="form-message"></span>
                            @error('password')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-xs-12 password" style="position: relative">
                            <label class="require">Nhập lại mật khẩu mới :</label>
                            <input class="form-control" id="password_confirm" placeholder="" type="password" name="password_confirm" value="">
                            <a href="javascript:;void(0);" style="position: absolute;top: 32px;right: 6%;"><i class="fa fa-eye"></i></a>
                            <span class="form-message"></span>
                            @error('password_confirm')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-xs-12">
                            <div class="btn-set">
                                <button class="btn-up" type="submit">
                                    <i class="far fa-check-circle"></i>
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('jsblock')

<script>
    $(function () {
        $(".form-group a").click(function() {
            let $this = $(this);

            if($this.hasClass('active')){
                $this.parents('.form-group').find('input').attr('type','password');
                $this.removeClass('active');
            }else{
                $this.parents('.form-group').find('input').attr('type','text');
                $this.addClass('active');
            }
        });
    });
</script>

<script>
    Validator({
     form: '#password-form',
     formGroupSelector: '.form-group',
     errorSelector: '.form-message',
     rules: [
       Validator.isRequired('#password'),
       Validator.isRequired('#password_old'),
       Validator.minLength('#password_old',6),
       Validator.minLength('#password',6),
       Validator.isRequired('#password_confirm'),
   ]
   });
</script>

@endsection

