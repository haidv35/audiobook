<!DOCTYPE html>
<html lang="en">
  @include('admin.layouts.header')
  <body>
    <!--[if lt IE 10]>
    <div class="page-message" role="alert">You are using an <strong>outdated</strong> browser. Please <a class="alert-link" href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</div>
    <![endif]-->
    <!-- .auth -->
    <main class="auth auth-floated">
      <!-- form -->
    <form class="auth-form" action="{{ route('admin.login') }}" method="POST">
        @csrf
        <div class="mb-4">
          <div class="mb-3">
            <img class="rounded" src="/looper/assets/apple-touch-icon.png" alt="" height="72">
          </div>
          <h1 class="h3"> Đăng nhập </h1>
        </div>
        </p><!-- .form-group -->
        <div class="form-group mb-4">
            <label class="d-block text-left" for="username">Email/Tài khoản</label>
            <input type="text" id="username" name="username" class="form-control form-control-lg @error('username') is-invalid @enderror" value="{{ old('username') }}" required autocomplete="username" autofocus>
            @error('username')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div><!-- /.form-group -->

        <!-- .form-group -->
        <div class="form-group mb-4">
            <label class="d-block text-left" for="password">Mật khẩu</label>
            <input type="password" id="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" required autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group mb-4">
          <button class="btn btn-lg btn-primary btn-block" type="submit">Đăng nhập</button>
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group text-center">
          <div class="custom-control custom-control-inline custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="custom-control-label" for="remember">Ghi nhớ</label>
          </div>
        </div><!-- /.form-group -->
        <!-- recovery links -->
        @if (Route::has('password.request'))
            <p class="py-2">
                <a href="{{ route('password.request') }}" class="link">Quên mật khẩu?</a>
            </p><!-- /recovery links -->
        @endif
        <!-- copyright -->
        <p class="mb-0 px-3 text-muted text-center"> © 2019 Audiobook.
        </p>
      </form><!-- /.auth-form -->
      <!-- .auth-announcement -->
      <div id="announcement" class="auth-announcement" style="background-image: url(/looper/assets/images/illustration/img-1.png);">
        <div class="announcement-body">
          {{-- <h2 class="announcement-title">  </h2><a href="#" class="btn btn-warning"><i class="fa fa-fw fa-angle-right"></i> Check Out Now</a> --}}
        </div>
      </div><!-- /.auth-announcement -->
    </main><!-- /.auth -->
    <script src="/looper/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/looper/assets/vendor/bootstrap/js/popper.min.js"></script>
    <script src="/looper/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/looper/assets/vendor/particles.js/particles.min.js"></script>
    <script>
      $(document).on('theme:init', () =>
      {
        particlesJS.load('announcement', '/looper/assets/javascript/pages/particles.json');
      })
    </script>
    <script src="/looper/assets/javascript/theme.min.js"></script>
  </body>
</html>
