@extends('admin.layouts.master')
@section('title')
  Nhóm quyền
@endsection
@section('content_head')
    <section class="content-header">
        <h1>
            NHÓM QUYỀN
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{route('role.index')}}"> Quyền</a></li>
            <li class="active">Thêm</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{route('role.create')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên</label>
                                <input name="name" type="text" class="form-control" placeholder=""
                                       value="{{old('name')}}">
                                <span class="error-message text text-danger">{{ $errors->first('name') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hiển thị</label>
                                <input name="display_name" type="text" class="form-control" placeholder=""
                                       value="{{old('display_name')}}">
                                <span class="error-message text text-danger">{{ $errors->first('display_name') }}</span>
                            </div>
                            <label for="exampleInputEmail1">Chọn chức năng</label>
                            <div class="form-group">
                                @foreach ($permissions as $key => $permission)
                                    @if ($key % 5 == 0)
                                        <br>
                                    @endif
                                <div class="checkbox" style="display: inline-block; width: 250px">
                                    <label style="display: block">
                                        <input type="checkbox" name="permission[]" value="{{$permission->id}}">
                                        {{$permission->display_name}}
                                    </label>
                                </div>
                                @endforeach
                            </div>

                            <span class="error-message text text-danger">{{ $errors->first('permission') }}</span>
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
