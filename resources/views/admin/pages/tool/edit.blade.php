@extends('admin.layouts.master')

@section('content_head')
<section class="content-header">
    <h1>
      SỬA DỤNG CỤ
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
      <li><a href="{{route('tool.list')}}"></i> Dụng cụ</a></li>
      <li class="active">Sửa</li>
    </ol>
  </section>
@endsection
@section('content')
<form style="padding: 8px 8px; border-radius: 4px" role="form" class="form" method="post" action="{{route('tool.update',$tools->id)}}" enctype="multipart/form-data" id="form-add">
    @csrf
<div class="row container-fluid">
        <div class="col-md-9">
            <div class="tabbable-custom" style="background-color: white; border: 1px solid #ddd; border-radius: 4px; padding: 15px;">
                <input type="hidden" name="id" value="{{$tools->id}}">
                <div class="form-group">
                    <label for="title" >Tên :</label>
                    <input class="form-control" id="title"  type="text" name="name" value="{{$tools->name}}">
                    <span class="form-message"></span>
                    @error('name')
                        <span class="error">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="tabbable-custom" style="background-color: white; border: 1px solid #ddd; border-radius: 4px; padding: 15px;">
                <div class="col">
                    <div class="form-group">
                        <label>Ảnh :</label>
                        <input class="form-control" accept="image/*" placeholder="" type="file" name="photo" onchange="readURL(this);">
                        @error('photo')
                            <span class="error">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <img src="{{url('admin/photo/tool',$tools->photo)}}" height="200" width="100%" id="preview" alt="photo/event">
                </div>
                <br>
                <div class="col">
                <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Lưu</button>
                </div>
            </div>
        </div>
</div>
</form>

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
