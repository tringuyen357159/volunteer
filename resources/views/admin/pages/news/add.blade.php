@extends('admin.layouts.master')

@section('content_head')
<section class="content-header" style="margin-bottom: 20px">
    <h1>
      Thêm tin tức
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li><a href="{{route('news.show')}}"> Tin tức</a></li>
        <li class="active">Thêm tin tức</li>
      </ol>
  </section>
@endsection
@section('content')
        <form id="form-add" style="padding: 8px 8px; border-radius: 4px" role="form" method="post" action="{{route('news.add')}}" enctype="multipart/form-data">
            @csrf
            <div class="row container-fluid">
            <div class="col-md-9">
            <div class="tabbable-custom" style="background-color: white; border: 1px solid #ddd; border-radius: 4px; padding: 15px;">
            <div class="form-group">
                <label class="require">Tiêu đề :</label>
                <input id="title" class="form-control" placeholder="Tiêu đề" type="text" name="title" value="{{old('title')}}">
                <span class="form-message"></span>
                @error('title')
                    <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label class="require">Người đăng :</label>
                <input id="poster" class="form-control" placeholder="Người đăng" type="text" name="poster" value="{{old('poster')}}">
                <span class="form-message"></span>
                @error('poster')
                    <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label class="require">Tóm lược :</label>
                <textarea id="summary" class="form-control" name="summary">{{old('summary')}}</textarea>
                <span class="form-message"></span>
                @error('summary')
                    <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label class="require">Nội dung :</label>
                <textarea id="editor" name="content">{{old('content')}}</textarea>
                @error('content')
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
                <img src="{{asset('admin/img/unnamed.png')}}" height="100" width="100%" id="preview" alt="photo news" onchange="readURL(this);">
            </div>
            <br>
            <div class="col">
                <div class="form-group">
                    <label>Loại tin tức: </label>
                    <select name="type" class="form-control">
                        <option selected="selected" value="Volunteering">Tình nguyện</option>
                        <option value="Organisations">Tổ chức</option>
                        <option value="Our Blog">Blog</option>
                    </select>
                    @error('type')
                        <span class="error">{{$message}}</span>
                    @enderror
                </div>
            </div>
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
    tinymce.init({
      selector: '#editor',
      height: "1000",
          });
  </script>
{{-- <script>
    CKEDITOR.replace('editor');
</script> --}}
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
    form: '#form-add',
    formGroupSelector: '.form-group',
    errorSelector: '.form-message',
    rules: [
      Validator.isRequired('#title', 'Vui lòng nhập trường này'),
      Validator.isRequired('#poster', 'Vui lòng nhập trường này'),
      Validator.isRequired('#summary', 'Vui lòng nhập trường này'), ,
],

  });
</script>
@endsection
