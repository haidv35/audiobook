@extends('home.layouts.app')
@section('app-main')
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">

    <!-- ============================ COMPONENT REGISTER   ================================= -->
        <div class="card mx-auto" style="max-width:520px; margin-top:40px;">
            <article class="card-body">
            <header class="mb-4"><h4 class="card-title">Đăng nhập với facebook</h4></header>
            <form method="POST" action="{{ route('facebook.login') }}" id="facebook-form">
                @csrf
                    <div class="form-row">
                        <div class="col form-group">
                            <label>Họ</label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror" placeholder="" name="firstname" value="{{ $getInfo->firstname }}" disabled autocomplete="firstname" autofocus>
                            @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> <!-- form-group end.// -->
                        <div class="col form-group">
                            <label>Tên</label>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror" placeholder="" name="lastname" value="{{ $getInfo->lastname }}" disabled autocomplete="lastname" autofocus>
                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> <!-- form-group end.// -->
                    </div> <!-- form-row end.// -->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="" name="email" value="{{ $getInfo->email }}" disabled autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> <!-- form-group end.// -->
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> <!-- form-group end.// -->
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" placeholder="" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> <!-- form-group end.// -->
                    <div class="form-group">
                        <label>Facebook</label>
                        <input type="text" class="form-control @error('facebook') is-invalid @enderror" placeholder="" name="facebook" value="{{ $getInfo->id }}" disabled autocomplete="facebook" autofocus>
                        @error('facebook')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Tài khoản</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="" name="username" value="{{ old('username') }}" autocomplete="username" autofocus>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Mật khẩu</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="" name="password" required >
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> <!-- form-group end.// -->
                        <div class="form-group col-md-6">
                            <label>Nhập lại mật khẩu</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="" name="password_confirmation" required>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> <!-- form-group end.// -->
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary btn-block" id="continue"> Tiếp tục  </button>
                    </div>
                </form>
            </article><!-- card-body.// -->
        </div> <!-- card .// -->
        <p class="text-center mt-4">Đã có tài khoản? <a href="{{ route('login') }}">Đăng Nhập</a></p>
        <br><br>
    <!-- ============================ COMPONENT REGISTER  END.// ================================= -->


</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
@endsection
@section('custom-footer')
    <script>
        let loginUrl = "{{ route('facebook.login') }}";
    </script>
    <script src="/js/login-facebook.js"></script>
@endsection

