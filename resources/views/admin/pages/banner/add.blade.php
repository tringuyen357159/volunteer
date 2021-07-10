@extends('admin.layouts.master')

@section('content_head')
    <section class="content-header">
        <h1>
            THÊM BANNER
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a
                ></li>
            <li><a href="{{route('banner.index')}}"> Banner</a></li>
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
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{route('banner.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tiêu đề</label>
                                <input name="title" type="text" class="form-control" placeholder=""
                                       value="{{old('title')}}">
                                <span class="error-message text text-danger">{{ $errors->first('title') }}</span>
                            </div>
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea id="mytextarea" name="summary" class="description form-control" rows="3"
                                          placeholder="">{{old('summary')}}</textarea>
                                <span class="error-message text text-danger">{{ $errors->first('summary') }}</span>
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
                        <div class="box-body">
                            <div class="form-group">
                                <img src="{{asset('photo/preview.png')}}" width="100%" id="preview" alt="photo banner">
                                <input class="form-control" accept="image/*" placeholder="" type="file" name="photo"
                                       onchange="readURL(this);">
                                <span class="error-message text text-danger">{{ $errors->first('photo') }}</span>
                            </div>
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
        CKEDITOR.replace('summary');
    </script>
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
    {{-- <script>
        tinymce.init({
          selector: 'textarea',
          plugins: 'media table',
       });
      </script> --}}
@endsection
