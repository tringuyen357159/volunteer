@extends('main.layouts.main')
@section('title')
    Tài Trợ
@endsection
@section('body')
<section class="donate">
    <div class="bg-container">
        <div class="header-donate">
            <div class="header-left" data-aos="fade-right" data-aos-duration="2000">
                <img src="{{asset('home/img/donate.jpg')}}" alt="">
            </div>
            <div class="header-right" data-aos="fade-left" data-aos-duration="2000">
                <h1>Hãy góp phần để chung tay hỗ trợ cho cộng đồng để cộng đồng phát triển tốt đẹp hơn. </h1>
                <div class="donation">
                    <div class="donors">
                        <div class="number-donate">{{$sponsormore}}</div>
                        <div class="name-donate">Nhà Tài Trợ</div>
                    </div>
                    <div class="total-donate">
                        <div class="number-donate">{{number_format($fund)}} đ</div>
                        <div class="name-donate">Tổng Tài Trợ</div>
                    </div>
                </div>
                <div class="link-donate">
                    <h3>Cách Thức Hỗ Trợ: </h3>
                    <p><i  class="fas fa-university"></i> Số Tài Khoản: 0651000832010</p>
                    <p><i style="width: 17px" class="fas fa-mobile-alt"></i> Số Điện Thoại: 078387574</p>
                    <p><i class="far fa-envelope"></i> Email Liên Lạc: tinhnguyenduytan@gmail.com</p>
                </div>
                <p>Xin gửi lời cảm ơn chân thành đến các nhà tài trợ của chúng tôi.</p>
            </div>
        </div>
        <div class="header-manager" data-aos="fade-up" data-aos-duration="2000">
            <h1>Danh Sách Các Nhà Tài Trợ Tháng {{$month}}</h1>
            <table>
            <tr class="header-table">
                <th class="col">Tên Nhà Tài Trợ</th>
                <th class="col">Số Điện Thoại</th>
                <th class="col">Số Tiền Ủng Hộ</th>
                <th class="col">Địa Chỉ</th>
            </tr>
            @foreach ($sponsors as $item)
            <tr>
                <td class="col">
                    {{$item->name}}
                </td>
                <td class="col">
                    @if ($item->anonymous==1)
                        ******{{substr($item->phone,-4)}}
                    @else
                        {{$item->phone}}
                    @endif
                </td>
                <td class="col">  {{number_format($item->amount_financed)}} đ</td>
                <td class="col">{{$item->address}}</td>
            </tr>
            @endforeach
            </table>
        </div>
        {{-- chi tiết chi tiêu --}}
        <div class="header-manager" data-aos="fade-up" data-aos-duration="2000">
            <h1>Danh Sách Chi Tiết Chi Tiêu</h1>
            <table>
            <tr class="header-table">
                <th class="col">Tên Nhà Tài Trợ</th>
                <th class="col">Tên sự kiện</th>
                <th class="col">Số tiền dùng</th>
                <th class="col">Ngày dùng</th>
            </tr>
            @foreach ($detail_spending as $key=> $detail_spendings)
                <tr>
                    <td>{{$detail_spendings->name}}</td>
                    <td>{{$detail_spendings->title}}</td>
                    <td>{{number_format($detail_spendings->money)}} đ</td>
                    <td>{{ date('d-m-Y', strtotime($detail_spendings->created_at)) }}</td>
                </tr>
            @endforeach
            </table>
        </div>
    </div>
</section>
@endsection
