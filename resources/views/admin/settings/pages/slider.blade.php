@extends('admin.layouts.app')
@section('meta-tag')
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('title-header')
    Cập nhật Slider
@endsection
@section('app-main')
    <div class="row">
        <div class="col-xl-7">
            <div class="card">
                <div class="card-body">
                    <div class="list-group list-group-media mb-3">
                        @php
                            $counter = 1
                        @endphp
                        @if($slider != null)
                            @foreach ($slider as $key => $slide)
                                <div class="row mt-3">
                                    <div class="col-10">
                                        <a href="{{ $slide }}" class="list-group-item list-group-item-action" target="_blank">
                                            <div class="list-group-item-figure rounded-left" style="height:5rem;width:58%;">
                                                <img src="{{ $slide }}" alt="">
                                            </div>
                                            <div class="list-group-item-body">
                                                <h4 class="list-group-item-title"> Slide  {{ $counter }}</h4>
                                                {{-- <p class="list-group-item-text"> A incidunt, corrupti. Quasi, incidunt ab, vel quidem debitis fuga? Delectus, ipsam... </p> --}}
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-2 d-flex align-items-center">
                                        <a class="btn btn-danger btn-lg" href="/admin/page/slider/delete/{{ $key + 1 }}">Xoá</a>
                                    </div>
                                </div>
                                @php
                                    $counter++
                                @endphp
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-5">
            <div class="card">
                <div class="card-body">
                    <form action="/admin/page/slider/store" method="POST">
                        @csrf
                            <!-- .fieldset -->
                        <fieldset>
                            <legend>Tạo mới slide</legend>

                            <div class="form-group">
                                <label for="image_link">Đường dẫn ảnh</label>
                                <input type="text" class="form-control" id="image_link" name="image_link" >
                            </div>
                        </fieldset><!-- /.fieldset -->
                        <hr>
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
@section('custom-footer')

@endsection
