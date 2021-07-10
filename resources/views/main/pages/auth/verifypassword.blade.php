<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{asset('client/css/login.css')}}" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
               <div class="login">
                    <div class="login-heading">Thay đổi mật khẩu</div>
                         <div class="card-body">
                             <form method="POST" action="{{route('client.password.post')}}">
                              @csrf
                                <input type="hidden" name="token" value="{{$token}}">
                           <div class="form-group row">
                               <label for="password" class="signup-label">Mật khẩu mới</label>
                               <div class="col-md-6">
                                   <input id="password" type="password" class="form-control @error('password') is-invalid @enderror signup-input" name="password" autocomplete="new-password">

                                   @error('password')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                               </div>

                           </div>

                         <div class="form-group row">
                               <label for="password-confirm" class="signup-label">Nhập lại mật khẩu mới</label>
                               <div class="col-md-6">
                                   <input id="password-confirm" type="password" class="signup-input" name="password_confirmation" autocomplete="new-password">
                               </div>
                           </div>

                        <div class="form-group row mb-0">
                              <div class="col-md-6 offset-md-4">
                                   <button type="submit" class="signup-submit">
                                      Xác nhận
                                   </button>
                               </div>
                           </div>
                       </form>
                   </div>
               </div>
   </div>
</body>
</html>
