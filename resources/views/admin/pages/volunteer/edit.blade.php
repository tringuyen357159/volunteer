@extends('admin.layouts.master')

@section('content_head')
<section class="content-header">
    <h1>
      CHỌN QUYỀN NHÂN VIÊN
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
      <li><a href="{{route('volunteer.show')}}"> Tình nguyện viên</a></li>
      <li class="active">Chọn quyền nhân viên</li>
    </ol>
  </section>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary" style="display: none">
                <div class="box-header with-border">
                  <h3 class="box-title">Thông tin</h3>
                </div>
                <form role="form" method="POST" action="{{route('volunteer.update')}}" enctype="multipart/form-data">
                    @csrf
                  <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ngày sinh</label>
                        <input name="birthday" type="text" class="form-control" placeholder="" value="{{$volunteer->birthday}}">
                          <span class="error-message text text-danger">{{ $errors->first('email') }}</span>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Số điện thoại</label>
                        <input name="phone" type="text" class="form-control" placeholder="" value="{{$volunteer->phone}}">
                          <span class="error-message text text-danger">{{ $errors->first('phone') }}</span>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Địa chỉ</label>
                        <input name="address" type="text" class="form-control" placeholder="" value="{{$volunteer->address}}">
                          <span class="error-message text text-danger">{{ $errors->first('phone') }}</span>
                      </div>
                      <div class="form-group">
                        <label>Giới tính</label>
                        <input name="gender" type="text" class="form-control" placeholder="" value="{{$volunteer->gender}}">
                           <span class="error-message text text-danger">{{ $errors->first('gender') }}</span>
                        </div>
                        <div class="form-group">
                  </div>
                  <div class="form-group">
                        <label>User_id</label>
                        <input name="user_id" type="text" class="form-control" placeholder="" value="{{$volunteer->user_id}}">
                           <span class="error-message text text-danger">{{ $errors->first('gender') }}</span>
                        </div>
                        <div class="form-group">
                  </div>

              </div>
        </div>
        <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Nhóm quyền</h3>
                    </div>
                      <div class="box-body">
                         <div class="form-group">
                            <select multiple="" class="form-control" name="roles[]" >
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
