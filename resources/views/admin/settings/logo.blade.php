@extends('admin.layouts.app')
@section('app-main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card card-fluid">
                    <div class="card-body">
                        <div class="card-title text-center">
                            Chỉnh sửa logo
                        </div>
                        <form action="{{ route('settings.logo') }}" method="POST">
                            @csrf
                            <div class="row">
                              <div class="col-lg-2 d-flex align-items-center">
                                    <label for="logo">Logo link</label>
                              </div>
                              <div class="col-lg-10">
                                    <input type="text" class="form-control" name="logo" id="logo" placeholder="" value="{{ $logo }}">
                              </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-12 d-flex justify-content-center">
                                    <a href="{{ $logo }}" target="_blank"><img class="img-thumbnail" style="width:15rem;" src="{{ $logo }}" alt=""></a>
                                </div>
                            </div>
                            <div class="row mt-3 justify-content-center">
                                <button type="submit" class="btn btn-outline-success">Cập nhật</button>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-12">
                                    @if (Session::has('success'))
                                        <div class="alert alert-success d-flex justify-content-center" role="alert">
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-12">
                                    @if (Session::has('error'))
                                        <div class="alert alert-danger d-flex justify-content-center" role="alert">
                                            {{ Session::get('error') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
