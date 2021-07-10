@extends('admin.layouts.master')
@section('title')
   Sửa sự kiện
@endsection
@section('content_head')
<section class="content-header">
    <h1>
      SỬA SỰ KIỆN
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a
        ></li>
      <li><a href="{{route('event.list')}}"> Sự kiện</a
        ></li>
      <li class="active">Sửa</li>
    </ol>
  </section>
@endsection
@section('content')
<form style="padding: 8px 8px; border-radius: 4px" role="form" class="form" method="post" action="{{route('event.update',$events->id)}}" enctype="multipart/form-data" id="form-edit">
    @csrf
    <div class="row container-fluid">
        <div class="col-md-9">
            <div class="tabbable-custom" style="background-color: white; border: 1px solid #ddd; border-radius: 4px; padding: 15px;">
                <input type="hidden" name="id" value="{{$events->id}}">
                <div class="form-group">
                    <label>Tiêu đề :</label>
                    <input class="form-control" id="title" placeholder="" type="text" name="title" value="{{$events->title}}">
                    <span class="form-message"></span>
                    @error('title')
                        <span class="error">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Tóm lược :</label>
                    <textarea class="form-control" id="summary" name="summary">{!!$events->summary!!}</textarea>
                    <span class="form-message"></span>
                    @error('summary')
                        <span class="error">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nội dung :</label>
                    <textarea id="editor1" name="content">{!!$events->content!!}</textarea>
                    @error('content')
                        <span class="error">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Kinh phí dự trù :</label>
                    <input class="form-control" id="budget_estimates" placeholder="" type="text" name="budget_estimates" value="{{$events->budget_estimates}}">
                    <span class="form-message"></span>
                    @error('budget_estimates')
                        <span class="error">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Số lượng người tham gia :</label>
                    <input class="form-control" id="number_of_participants" placeholder="" type="text" name="number_of_participants" value="{{$events->number_of_participants}}">
                    <span class="form-message"></span>
                    @error('number_of_participants')
                        <span class="error">{{$message}}</span>
                    @enderror
                </div>


                <div class="form-group">
                    <label>Địa điểm :</label>
                    <input class="form-control" id="location" placeholder="" type="text" name="location" value="{{$events->location}}">
                    <span class="form-message"></span>
                    @error('location')
                        <span class="error">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="tabbable-custom" style="background-color: white; border: 1px solid #ddd; border-radius: 4px; padding: 15px;">
                <div class="row" style="padding:0px 15px">
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
                        <img src="{{url('admin/photo/event',$events->photo)}}" alt="photo" height="200" width="100%" id="preview">
                    </div>
                </div>
                <br>
                <div class="col">
                    <div class="form-group">
                        <label>Ngày bắt đầu :</label>
                        <input class="form-control" id="start_day" placeholder="mm/dd/yyyy hh:mm:ss" type="text" name="start_day" value="{{date('m/d/Y H:i:s', strtotime($events->start_day))}}">
                        <span class="form-message"></span>
                        @error('start_day')
                            <span class="error">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Ngày kết thúc :</label>
                        <input class="form-control" id="end_day" placeholder="mm/dd/yyyy hh:mm:ss" type="text" name="end_day" value="{{date('m/d/Y H:i:s', strtotime($events->end_day))}}">
                        <span class="form-message"></span>
                        @error('end_day')
                            <span class="error">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Loại sự kiện :</label>
                            <select name="type" class="form-control">
                                <option value="môi trường">môi trường</option>
                                <option value="thể thao">thể thao</option>
                                <option value="quyên tặng">quyên tặng</option>
                            </select>
                        @error('title')
                            <span class="error">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        @foreach ( $listTool as $key => $item )
                        <input {{ isset($eventTool[$item->id]) ? 'checked' : ''}} class="checkkk" type="checkbox" value="1" name="tool[{{ $item->id }}][isCheck]"> {{$item->name}}
                        <input type="text" placeholder="Số lượng" name="tool[{{ $item->id }}][quanlity]" value="{{isset($eventTool[$item->id]) ? $eventTool[$item->id]->quanlity : ''}}" style="display: none;"  class="cba">
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
    Validator({
          form: '#form-edit',
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
