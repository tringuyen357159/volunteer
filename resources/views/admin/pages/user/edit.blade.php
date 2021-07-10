@extends('admin.layouts.master')

@section('content_head')
<section class="content-header">
    <h1>
      SỬA NHÓM QUYỀN NHÂN VIÊN
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
      <li><a href="{{route('user.index')}}"> Nhân viên</a></li>
      <li class="active">Sửa</li>
    </ol>
  </section>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Nhóm quyền</h3>
                    </div>
                    <form role="form" method="POST" action="{{route('user.update', $user->id)}}">
                        @csrf
                      <div class="box-body">
                         <div class="form-group">
                            <select multiple="" class="form-control" name="roles[]"  style="height: 200px;">
                                @foreach ($roles as $role)
                                <option
                                {{$listRoleOfUser->contains($role->id) ? 'selected' : ''}}
                                value="{{$role->id}}">{{$role->display_name}}</option>
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
@endsection
