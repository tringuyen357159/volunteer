@extends('admin.layouts.master')

@section('content_head')
<section class="content-header">
    <h1>
     TẠO TÀI KHOẢN
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
      <li>Tạo TK</li>
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
                <form role="form" method="POST" action="{{route('user.doneparse', $sponsor->id)}}" enctype="multipart/form-data">
                    @csrf
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tên</label>
                      <input name="name" type="text" class="form-control" placeholder="" value="{{$sponsor->name}}">
                        <span class="error-message text text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input name="email" type="email" class="form-control" placeholder="" value="{{$sponsor->email}}">
                          <span class="error-message text text-danger">{{ $errors->first('email') }}</span>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Số điện thoại</label>
                        <input name="phone" type="text" class="form-control" placeholder="" value="{{$sponsor->phone}}">
                          <span class="error-message text text-danger">{{ $errors->first('phone') }}</span>
                      </div>

                        <div class="form-group">
                        <label for="exampleInputEmail1">Địa chỉ</label>
                        <input name="address" type="text" class="form-control" placeholder="" value="{{$sponsor->address}}">
                          <span class="error-message text text-danger">{{ $errors->first('address') }}</span>
                      </div>
                    <div class="form-group">
                      <label>Mật khẩu</label>
                      <input name="password" type="password" class="form-control" placeholder="" value="">
                        <span class="error-message text text-danger">{{ $errors->first('password') }}</span>
                    </div>
                    {{-- <div class="form-group">
                        <label>Ngày sinh</label>
                        <input name="birthday" type="date" class="form-control" placeholder="" value="{{old('birthday')}}">
                          <span class="error-message text text-danger">{{ $errors->first('birthday') }}</span>
                      </div> --}}
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
@endsection
