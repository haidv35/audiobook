@extends('admin.layouts.app')
@section('app-main')
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-fluid">
                <div class="card-body">
                    <div class="card-title text-center">
                        <h5>Cấu hình thông tin Momo trong mã QR</h5>
                        <hr>
                    </div>
                    <form action="{{ route('settings.payments') }}/momoString" method="POST">
                        @csrf
                        <p class="text-danger text-center"> *Điền thông tin giống như thông tin phần ví của tôi trong Momo</p>
                        @php
                            $momoStr = explode('|',$qrStr);
                            $phone = $momoStr[2];
                            $fullname = $momoStr[3];
                            $email = $momoStr[4];
                        @endphp
                        <div class="row my-2">
                            <div class="col-3 d-flex align-items-center"><label for="phone">Điện thoại</label></div>
                            <div class="col-9"><input type="text" class="form-control" name="phone" value="{{ $phone }}"></div>
                        </div>
                        <div class="row my-2">
                            <div class="col-3 d-flex align-items-center"><label for="fullname">Họ và tên</label></div>
                            <div class="col-9"><input type="text" class="form-control" name="fullname" value="{{ $fullname }}"></div>
                        </div>
                        <div class="row my-2">
                            <div class="col-3 d-flex align-items-center"><label for="email">Email</label></div>
                            <div class="col-9"><input type="text" class="form-control" name="email" value="{{ $email }}"></div>
                        </div>
                        <div class="row justify-content-center mt-4">
                            <input type="submit" class="btn btn-outline-success" value="Cập nhật">
                        </div>
                        @if (Session::has('success-momoString'))
                            <div class="alert alert-success w-100 mt-2" role="alert">
                                {{ Session::get('success-momoString') }}
                            </div>
                        @endif
                        @if (Session::has('error-momoString'))
                            <div class="alert alert-danger w-100 mt-2" role="alert">
                                {{ Session::get('error-momoString') }}
                            </div>
                        @endif
                        <p class="text-muted mt-3">Dùng ứng dụng Momo và nhấn vào quét mã để kiểm tra mã đã chính xác với tài khoản của bạn hay chưa. </p>
                        <div class='row justify-content-center'>
                            {!! QrCode::size(300)->generate($qrStr) !!}
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row mb-5">
                <div class="col-12">
                    <div class="card card-fluid">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <h5>Cấu hình thông tin tự động thanh toán Momo</h5>
                                <hr>
                            </div>
                            <form action="{{ route('settings.payments') }}/momoAuto" method="POST">
                                @csrf
                                <p class="text-danger text-center"> *Điền email và mật khẩu của tài khoản được liên kết với Momo</p>
                                <div class="row my-2">
                                    <div class="col-4 d-flex align-items-center"><label for="email">Email</label></div>
                                    <div class="col-8"><input type="text" class="form-control" name="email" value="{{ $gmail }}"></div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-4 d-flex align-items-center"><label for="password">Mật khẩu ứng dụng</label></div>
                                    <div class="col-8"><input type="text" class="form-control" name="password" value="{{ $password }}"></div>
                                </div>
                                <div class="row justify-content-center mt-4">
                                    <input type="submit" class="btn btn-outline-success" value="Cập nhật">
                                </div>
                                @if (Session::has('success-momoAuto'))
                                    <div class="alert alert-success w-100 mt-2" role="alert">
                                        {{ Session::get('success-momoAuto') }}
                                    </div>
                                @endif
                                @if (Session::has('error-momoAuto'))
                                    <div class="alert alert-danger w-100 mt-2" role="alert">
                                        {{ Session::get('error-momoAuto') }}
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card card-fluid">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <h5>Cấu hình thông tin ngân hàng</h5>
                                <hr>
                            </div>
                            <form action="{{ route('settings.payments') }}/bank" method="POST">
                                @csrf
                                <div class="row my-2">
                                    <div class="col-3 d-flex align-items-center"><label for="fullname">Họ và tên</label></div>
                                    <div class="col-9"><input type="text" class="form-control" name="fullname" value="{{ $bank->fullname }}"></div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-3 d-flex align-items-center"><label for="branch">Chi nhánh</label></div>
                                    <div class="col-9"><input type="text" class="form-control" name="branch" value="{{ $bank->branch }}"></div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-3 d-flex align-items-center"><label for="acc_num">Số tài khoản</label></div>
                                    <div class="col-9"><input type="text" class="form-control" name="acc_num" value="{{ $bank->acc_num }}"></div>
                                </div>
                                <div class="row justify-content-center mt-4">
                                    <input type="submit" class="btn btn-outline-success" value="Cập nhật">
                                </div>
                                @if (Session::has('success-bank'))
                                    <div class="alert alert-success w-100 mt-2" role="alert">
                                        {{ Session::get('success-bank') }}
                                    </div>
                                @endif
                                @if (Session::has('error-bank'))
                                    <div class="alert alert-danger w-100 mt-2" role="alert">
                                        {{ Session::get('error-bank') }}
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
