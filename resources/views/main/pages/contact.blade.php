@extends('main.layouts.main')
@section('title')
    Liên Hệ
@endsection
@section('body')
<section class="contact" id="contact">
    <div class="container">
        <h2 class="title" data-aos="fade-down" data-aos-duration="2000">Liên Hệ Với Chúng Tôi</h2>
        <div class="contact-content">
            <div class="column left" data-aos="fade-up" data-aos-duration="2000">
                <div class="text">Thông Tin Của Chúng Tôi</div>
                <p>Dưới đây là mọi thông tin liên lạc của chúng tôi, xin hãy liên lạc với chúng tôi khi thật sự cần thiết. Xin chân thành Cảm ơn.</p>
                <div class="icons">
                    <div class="row">
                        <i class="fas fa-user"></i>
                        <div class="info">
                            <div class="head">Tên</div>
                            <div class="sub-title">Trường đại học Duy Tân</div>
                        </div>
                    </div>
                    <div class="row">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="info">
                            <div class="head">Địa Chỉ</div>
                            <div class="sub-title">Thanh Khê, Đà Nẵng</div>
                        </div>
                    </div>
                    <div class="row">
                        <i class="fas fa-envelope"></i>
                        <div class="info">
                            <div class="head">Email</div>
                            <div class="sub-title"><a href="mailto:tinhnguyenduytan@gmail.com">tinhnguyenduytan@gmail.com</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column right" data-aos="fade-up" data-aos-duration="2000">
                <div class="text">Gửi Lời Nhắn</div>
                <form role="form" method="post" enctype="multipart/form-data" action="{{route('feedback.store')}}">
                    @csrf
                    <div class="fields">
                        <div class="field name">
                            <input type="text" name="name" placeholder="Họ và tên" required>
                            @error('name')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="field email">
                            <input type="email" name="email" placeholder="Email" required>
                            @error('email')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="fields">
                        <div class="field name">
                            <input type="text" name="address" placeholder="Địa chỉ" required>
                            @error('address')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="field email">
                            <input type="text" name="phone" placeholder="Số điện thoại" required>
                            @error('phone')
                            <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="field">
                        <input type="text" name="topic" placeholder="Chủ đề" required>
                        @error('topic')
                            <span class="error">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="field textarea">
                        <textarea cols="30" rows="10" name="content" placeholder="Chi tiết ..." required></textarea>
                        @error('content')
                        <span class="error">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="button">
                        <button class="submit">Gửi Tin Nhắn</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
