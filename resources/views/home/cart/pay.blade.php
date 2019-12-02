@extends('home.layouts.app')
@section('custom-header')
<link rel="stylesheet" href="/looper/assets/vendor/open-iconic/css/open-iconic-bootstrap.min.css">
<link rel="stylesheet" href="/looper/assets/vendor/fontawesome/css/all.css"><!-- END PLUGINS STYLES -->
<!-- BEGIN THEME STYLES -->
<link rel="stylesheet" href="/looper/assets/stylesheets/theme.min.css" data-skin="default">
<link rel="stylesheet" href="/looper/assets/stylesheets/custom.css"><!-- Disable unused skin immediately -->
@endsection
@section('app-main')
<div class="container">
    <div class="section-block">
        <!-- Default Steps -->
        <!-- .bs-stepper -->
        <div id="stepper" class="bs-stepper">
            <!-- .card -->
            <div class="card">
                <!-- .card-header -->
                <div class="card-header">
                    <!-- .steps -->
                    <div class="steps steps-" role="tablist">
                        <ul>
                            <li class="step">
                                <a class="step-trigger" tabindex="-1" aria-selected="true" style="opacity: 0.4"><span
                                        class="step-indicator step-indicator-icon"><i class="oi oi-cart"></i></span>
                                    <span class="d-none d-sm-inline">Chọn sản phẩm</span></a>
                            </li>
                            {{-- <li class="step" data-target="#test-l-1">
                                <a href="#" class="step-trigger" tabindex="-1" aria-selected="false"><span
                                        class="step-indicator step-indicator-icon"><i
                                            class="oi oi-account-login"></i></span> <span
                                        class="d-none d-sm-inline">Chọn sản phẩm</span></a>
                            </li> --}}
                            <li class="step active">
                                <a class="step-trigger" tabindex="-1" aria-selected="true"><span
                                        class="step-indicator step-indicator-icon"><i
                                            class="oi oi-credit-card"></i></span>
                                    <span class="d-none d-sm-inline">Tiến hành mua</span></a>
                            </li>
                            <li class="step">
                                <a class="step-trigger" tabindex="-1" aria-selected="true" style="opacity: 0.4"><span
                                        class="step-indicator step-indicator-icon"><i class="oi oi-basket"></i></span>
                                    <span class="d-none d-sm-inline">Xem sản phẩm</span></a>
                            </li>
                        </ul>
                    </div><!-- /.steps -->
                </div><!-- /.card-header -->
                <!-- .card-body -->
                <div class="card-body">
                    <form id="stepper-form" name="stepperForm" class="">
                        <!-- .content -->
                        <div id="test-l-2" class="content fade active dstepper-block mb-5">
                            @foreach ($orderDetailItems as $item)
                                <div class="row justify-content-center mb-4">
                                    <div class="col-lg-10">
                                        {{ $item->title }}
                                    </div>
                                    <div class="col-lg-2 price">
                                        {{ $item->price }}
                                    </div>
                                </div>
                            @endforeach
                            <hr>
                            <div class="row justify-content-center my-5">
                                <h3><span class="text-muted">Tổng thanh toán: </span><span class='price' style='color:red;font-weight:bold;'>{{ $amount }}</span></h3>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mt-2">
                                    <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal"
                                        data-target="#bank">Ngân hàng</button>
                                </div>
                                <div class="col-lg-6 mt-2">
                                    <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal"
                                        data-target="#momo">Momo</button>
                                </div>
                            </div>
                        </div><!-- /.content -->
                    </form><!-- /form -->
                </div><!-- /.card-body -->
                <div class="modal fade" id="bank" tabindex="-1" role="dialog" aria-labelledby="bankModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p>Họ tên: {{ $bank->fullname }}</p>
                                <p>Chi nhánh: {{ $bank->branch }}</p>
                                <p>Số tài khoản: <span style="color:red">{{ $bank->acc_num }}</span></p>
                                {{-- <p>Số tiền: <span class="price" style="color:red;">{{ $amount }}</span></p> --}}
                                <p>Lời nhắn: <span style="color:red;">{{ $paymentCodes[0]->code }}</span></p>
                            </div>
                            <div class="modal-footer">
                                <div class="col-lg-6">
                                    <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Đóng</button>
                                </div>
                                <div class="col-lg-6">
                                    <a href="/user/orders" class="btn btn-success btn-block">Hoàn thành</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="momo" tabindex="-1" role="dialog" aria-labelledby="momoModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                {{-- <h4 class="text-center mt-4">Số tiền: <span class="price" style="color:red;">{{ $amount }}</span></h4> --}}
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
                                <p class="text-center"><span style="color:red;">{{ $paymentCodes[1]->code }}</span></p>
                                <hr>
                                <small>Momo được thanh toán tự động. Bạn vui lòng chờ 1-5 phút để thanh toán hoàn tất. Chú ý bạn phải nhập đúng lời nhắn nếu không đơn của bạn sẽ không được xác nhận!.</small>
                            </div>
                            <div class="modal-footer">
                                <div class="col-lg-6">
                                    <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Đóng</button>
                                </div>
                                <div class="col-lg-6">
                                    <a href="/user/orders" class="btn btn-success btn-block">Hoàn thành</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.card -->
        </div><!-- /.bs-stepper -->
    </div>
</div>
@endsection
