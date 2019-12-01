@extends('user.layouts.app')
@section('app-main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- .card -->
            <div class="card card-fluid">
                <h6 class="card-header"> Thông tin tài khoản </h6><!-- .card-body -->
                <div class="card-body">
                    <!-- form -->
                    <form method="post" action="/user/profile">
                        @csrf
                        <!-- form row -->
                        <div class="form-row">
                            <!-- form column -->
                            <div class="col-md-6 mb-3">
                                <label for="firstname">Họ</label>
                                <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname" value="{{ $user->firstname }}" required="">
                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div><!-- /form column -->

                            <!-- form column -->
                            <div class="col-md-6 mb-3">
                                <label for="lastname">Tên</label>
                                <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname" name="lastname" value="{{ $user->lastname }}" required="">
                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div><!-- /form column -->
                        </div><!-- /form row -->
                        <!-- .form-group -->
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $user->phone }}" required="">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div><!-- /.form-group -->
                        <div class="form-group">
                            <label for="phone">Facebook</label>
                            <input type="text" class="form-control @error('fb_id') is-invalid @enderror" id="fb_id" name="fb_id" value="{{ ($user->fb_id != '0') ? $user->fb_id : ''}}" placeholder="http://fb.com/123">
                            @error('fb_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div><!-- /.form-group -->
                        <!-- .form-group -->
                        <div class="form-group">
                            <label for="address">Địa chỉ</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ $user->address }}" required="">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div><!-- /.form-group -->
                        <!-- .form-group -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}" required="">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div><!-- /.form-group -->
                        <!-- .form-group -->
                        <div class="form-group">
                            <label for="password">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div><!-- /.form-group -->
                        <!-- .form-group -->
                        <div class="form-group">
                            <label for="username">Tài khoản</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ $user->username }}" required="" disabled>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div><!-- /.form-group -->

                        <hr>
                        <!-- .form-actions -->
                        <div class="form-actions">
                            <!-- enable submit btn when user type their current password -->
                            <input type="password" class="form-control mr-3 @error('old_password') is-invalid @enderror" id="old_password" name="old_password" placeholder="Nhập mật khẩu cũ" required="">
                            @error('old_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <button type="submit" class="btn btn-primary text-nowrap ml-auto">Cập nhật tài khoản</button>
                        </div><!-- /.form-actions -->
                    </form><!-- /form -->
                </div><!-- /.card-body -->
                <div class="card-footer">
                        @if (Session::has('success'))
                            <div class="alert alert-success w-100 mt-2" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                        @if (Session::has('not_match'))
                            <div class="alert alert-danger w-100 mt-2" role="alert">
                                {{ Session::get('not_match') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div><!-- /.card -->
        </div><!-- /grid column -->
    </div>
</div>
@endsection
