@extends('admin.layouts.master')
@section('title')
   Thêm sự kiện
@endsection
@section('content_head')
<section class="content-header" style="margin-bottom: 20px">
    <h1>
      THÊM SỰ KIỆN
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a
            ></li>
        <li><a href="{{route('event.list')}}"> Sự kiện</a
            ></li>
        <li class="active">Thêm</li>
      </ol>
  </section>
@endsection
@section('content')
    <form style="padding: 8px 8px; border-radius: 4px" role="form" class="form" method="post" action="{{route('event.add')}}" enctype="multipart/form-data" id="form-add-event">
            @csrf
        <div class="row container-fluid">
                <div class="col-md-9">
                    <div class="tabbable-custom" style="background-color: white; border: 1px solid #ddd; border-radius: 4px; padding: 15px;">
                        <div class="form-group">
                            <label for="title" >Tiêu đề :</label>
                            <input class="form-control" id="title"  type="text" name="title" value="{{old('title')}}">
                            <span class="form-message"></span>
                            @error('title')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="summary">Tóm lược : </label>
                            <textarea class="form-control" id="summary"  name="summary">{{old('summary')}}</textarea>
                            <span class="form-message"></span>
                            @error('summary')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="editor1">Nội dung :</label>
                            <textarea id="editor1" name="content">{{old('content')}}</textarea>
                            <span class="form-message"></span>
                            @error('content')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="budget_estimates">Kinh phí dự trù :</label>
                            <input class="form-control" id="budget_estimates" type="text" name="budget_estimates" value="{{old('budget_estimates')}}">
                            <span class="form-message"></span>
                            @error('budget_estimates')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="number_of_participants">Số lượng người tham gia :</label>
                            <input class="form-control" id="number_of_participants" type="text" name="number_of_participants" value="{{old('number_of_participants')}}">
                            <span class="form-message"></span>
                            @error('number_of_participants')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="location">Địa điểm :</label>
                            <input class="form-control" id="location" type="text" name="location" value="{{old('location')}}">
                            <span class="form-message"></span>
                            @error('location')
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
                                <input class="form-control" accept="image/*"  placeholder="" type="file" name="photo" onchange="readURL(this);">
                                @error('photo')
                                    <span class="error">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <img src="http://placehold.it/180" height="200" width="100%" id="preview" alt="photo/event">
                        </div>
                        <br>
                        <div class="col">
                            <div class="form-group">
                                <label for="start_day">Ngày bắt đầu :</label>
                                <input class="form-control" id="start_day" placeholder="mm/dd/yyyy hh:mm:ss" type="text" name="start_day" value="{{old('start_day')}}">
                                <span class="form-message"></span>
                                @error('start_day')
                                    <span class="error">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="end_day">Ngày kết thúc :</label>
                                <input class="form-control" id="end_day" placeholder="mm/dd/yyyy hh:mm:ss" type="text" name="end_day" value="{{old('end_day')}}">
                                <span class="form-message"></span>
                                @error('end_day')
                                    <span class="error">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label id="province">Loại sự kiện :</label>
                                    <select name="type" class="form-control" id="province">
                                        <option value="môi trường">môi trường</option>
                                        <option value="thể thao">thể thao</option>
                                        <option value="quyên tặng">quyên tặng</option>
                                    </select>
                                @error('type')
                                    <span class="error">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" >
                                @foreach ( $tools as $item )
                                    <input class="checkkk" type="checkbox" value="1" name="tool[{{ $item->id }}][isCheck]"> {{$item->name}}
                                    <input class="form-control" type="text" placeholder="Số lượng" name="tool[{{ $item->id }}][quanlity]" value="{{old('quanlity')}}" style="display: none;">
                                <br>
                                @endforeach
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
    CKEDITOR.replace( 'editor1' );
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
<script>
        // Mong muốn của chúng ta
        Validator({
          form: '#form-add-event',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
            Validator.isRequired('#title', 'Vui lòng nhập trường này'),
            Validator.isRequired('#summary'),
            Validator.isRequired('#location'),
            Validator.isBudget('#budget_estimates'),
            Validator.isNumber('#number_of_participants'),
            Validator.isStartDay('#start_day'),
            Validator.isStartDay('#end_day'),
        ]
        });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.checkkk').click(function () {
          $(this).next().toggleClass('abc')
        })
    })
</script>
<script type="text/javascript">
    $('.checkkk:checked').next().toggleClass('abc');
</script>
@endsection
