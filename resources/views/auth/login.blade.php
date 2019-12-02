@extends('home.layouts.app')
@section('app-main')
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-conten padding-y" style="min-height:84vh">

    <!-- ============================ COMPONENT LOGIN   ================================= -->
        <div class="card mx-auto" style="max-width: 380px; margin-top:100px;">
            <div class="card-body">
            <h4 class="card-title mb-4">Đăng Nhập</h4>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <input name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Tài khoản" type="text" value="{{ old('username') }}" required autocomplete="username" autofocus>
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> <!-- form-group// -->
                <div class="form-group">
                    <input name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mật khẩu" type="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> <!-- form-group// -->
                <div class="form-group">
                    {{-- @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="float-right">Quên mật khẩu?</a>
                    @endif --}}
                    <label class="float-left custom-control custom-checkbox"> <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> <div class="custom-control-label"> Ghi nhớ </div> </label>
                </div> <!-- form-group form-check .// -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"> Đăng nhập  </button>
                </div> <!-- form-group// -->
                <a href="{{ url('/auth/redirect/facebook') }}" class="btn btn-facebook btn-block mb-2"> <i class="fab fa-facebook-f"></i> &nbsp  Đăng nhập với Facebook</a>
                {{-- <a href="#" class="btn btn-google btn-block mb-4"> <i class="fab fa-google"></i> &nbsp Đăng nhập với Google</a> --}}
            </form>
            </div> <!-- card-body.// -->
        </div> <!-- card .// -->

            <p class="text-center mt-4">Chưa có tài khoản? <a href="/register">Đăng Kí</a></p>
            <br><br>
    <!-- ============================ COMPONENT LOGIN  END.// ================================= -->
    </section>
    <!-- ========================= SECTION CONTENT END// ========================= -->
@endsection
@section('custom-footer')
    <script>
        if($(location).attr('href') === "https://audiobook_final.test/login/#!"){
            showStackTopRight('error','Error!',"Bạn phải đăng nhập trước!");
        }
    </script>
@endsection

