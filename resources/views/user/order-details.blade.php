@extends('user.layouts.app')
@section('app-main')
<div class="container-fluid">
    @if ($status != 'paid')
        <div class="card-footer d-flex align-items-center mb-4">
            <a href="#" class="btn btn-lg btn-primary w-100 mr-3" data-toggle="modal" data-target="#bank">Chuyển Khoản</a>
            <a href="#" class="btn btn-lg btn-danger w-100" data-toggle="modal" data-target="#momo">Momo</a>
        </div>
        <div class="modal fade" id="bank" tabindex="-1" role="dialog" aria-labelledby="bankModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <p class="mt-4">Họ tên: {{ $bank->fullname }}</p>
                        <p>Chi nhánh: {{ $bank->branch }}</p>
                        <p>Số tài khoản: <span style="color:red">{{ $bank->acc_num }}</span></p>
                        <p>Số tiền: <span class="price" style="color:red;">{{ $amount }}</span></p>
                        <p>Lời nhắn: <span style="color:red;">{{ $payment_codes[0]->code }}</span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="momo" tabindex="-1" role="dialog" aria-labelledby="momoModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4 class="text-center mt-4">Số tiền: <span class="price" style="color:red;">{{ $amount }}</span></h4>
                        <p style="font-weight:bold;" class="text-center">Bước 1: Scan QR Code bằng ứng dụng momo</p>
                        @php
                            $qr_code = base64_encode(QrCode::format('png')->size(300)->generate($momo->qr_str."|".number_format(round($amount,2), 3, '', '')))
                        @endphp
                        <div class="row justify-content-center">
                            <img src="data:image/png;base64, {!! $qr_code !!}" alt="">
                        </div>
                        <div class="row justify-content-center">
                            <a download="qr_code.png" href="data:image/png;base64, {!! $qr_code !!}" class="btn btn-outline-success mb-3">
                                Tải về mã QR
                            </a>
                        </div>
                        <p style="font-weight:bold;" class="text-center">Bước 2: Gửi lời nhắn</p>
                        <p class="text-center"><span style="color:red;">{{ $payment_codes[1]->code }}</span></p>
                        <hr>
                        <small>Momo được thanh toán tự động. Bạn vui lòng chờ 1-5 phút để thanh toán hoàn tất. Chú ý bạn phải nhập đúng lời nhắn nếu không đơn của bạn sẽ không được xác nhận!.</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            @foreach ($order_detail_items as $item)
            <div class="row">
                <div class="col-lg-12">
                    <div class="list-group list-group-media mb-2">
                        <div class="list-group-item list-group-item-action">
                            <div class="list-group-item-figure rounded-left" style="width:4rem!important;">
                                <img src="{{ $item->product->image }}" class="img-fluid" alt="placeholder image">
                            </div>
                            <div class="list-group-item-body">
                                <div class="row">
                                    <div class="col-lg-10">
                                        <h4 class="list-group-item-title"> {{ $item->title }} </h4>
                                        <p class="list-group-item-text text-muted"> Danh mục:  {{ $item->category }}</p>
                                        <span class="text-muted">Giá tiền: </span><span class="price text-muted">{{ $item->price }}</span>
                                    </div>
                                    @if ($status === "paid")
                                        <div class="col-lg-2 mt-2">
                                            <a href="/user/purchased/{{ $item->product_id }}" class="btn btn-outline-primary">Xem sản phẩm</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
