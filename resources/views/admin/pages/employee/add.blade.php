@extends('admin.layouts.master')

@section('content_head')
<section class="content-header">
    <h1>
      THÊM NHÂN VIÊN
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
      <li><a href="{{route('employee.list')}}"> Nhân viên</a></li>
      <li class="active">Thêm</li>
    </ol>
  </section>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Thông tin</h3>
                </div>
                <form role="form" method="POST" action="{{route('employee.store')}}" enctype="multipart/form-data" id="add-employee">
                    @csrf
                  <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên</label>
                        <input name="name" type="text" id="fullname" class="form-control" placeholder="" value="{{old('name')}}">
                        <span class="form-message"></span>
                        <span class="error-message text text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input name="email" type="email" id="emaill" class="form-control" placeholder="" value="{{old('email')}}">
                        <span class="form-message"></span>
                        <span class="error-message text text-danger">{{ $errors->first('email') }}</span>
                    </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Số điện thoại</label>
                        <input name="phone" type="text" id="phone" class="form-control" placeholder="" value="{{old('phone')}}">
                        <span class="form-message"></span>
                        <span class="error-message text text-danger">{{ $errors->first('phone') }}</span>
                      </div>
                    <div class="form-group">
                        <label>Giới tính</label>
                        <select class="form-control" name="gender">
                            <option value="male" >Nam</option>
                            <option value="female" >Nữ</option>
                        </select>
                          <span class="error-message text text-danger">{{ $errors->first('gender') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Địa chỉ</label>
                        <input name="address" type="text" id="address" class="form-control" placeholder="" value="{{old('address')}}">
                        <span class="form-message"></span>
                        <span class="error-message text text-danger">{{ $errors->first('address') }}</span>
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input name="password" type="password" id="password" class="form-control" placeholder="" value="{{old('password')}}">
                        <span class="form-message"></span>
                        <span class="error-message text text-danger">{{ $errors->first('password') }}</span>
                    </div>
                    <div class="form-group">
                        <label>Ngày sinh</label>
                        <input name="birthday" type="date" id="birthday" class="form-control" placeholder="" value="{{old('birthday')}}">
                        <span class="form-message"></span>
                        <span class="error-message text text-danger">{{ $errors->first('birthday') }}</span>
                    </div>
                  </div>

              </div>
        </div>
        <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Hình ảnh</h3>
                    </div>
                      <div class="box-body">
                        <div class="form-group text-center">
                                <img class="img-circle" src="{{asset('photo/preview.png')}}" width="70%" id="preview" alt="photo user">
                                    <input class="form-control" placeholder="" type="file" name="photo" onchange="readURL(this);">
                                    <span class="error-message text text-danger">{{ $errors->first('photo') }}</span>
                          </div>
                      </div>
                  </div>

                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Nhóm quyền</h3>
                    </div>
                      <div class="box-body">
                         <div class="form-group">
                            <select multiple="" class="form-control" name="roles[]" style="height: 116px;" >
                                @foreach ($roles as $role)
                                <option value="{{$role->id}}">{{$role->display_name}}</option>
                                @endforeach
                            </select>
                             <span class="error-message text text-danger">{{ $errors->first('roles') }}</span>
                          </div>
                      </div>
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                      </div>
                    </form>
                  </div>
        </div>
    </div>

  </section>
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
     form: '#add-employee',
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
   ]
   });
</script>
@endsection
