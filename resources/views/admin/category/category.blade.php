@extends('admin.layouts.app')
@section('title-header')
    Trang Danh Mục
@endsection
@section('button-header')
    <a href="{{ route('admin.category')  }}" class="btn btn-light"><i class="fa fa-plus" aria-hidden="true"></i> <span class="ml-1">Thêm Mới</span></a>
    <button type="button" class="btn btn-light"><i class="oi oi-data-transfer-download"></i> <span class="ml-1">Export</span></button>
    <button type="button" class="btn btn-light"><i class="oi oi-data-transfer-upload"></i> <span class="ml-1">Import</span></button>
@endsection
@section('app-main')
    <div class="row">
        <div class="col-xl-6">
            <div class="card card-fluid">
                    <div class="card-header border-bottom-0"> Category </div><!-- .nestable -->
                    <div id="nestable" class="dd">
                        <ol class="dd-list"></ol>
                    </div><!-- /.nestanble -->
                    <!-- .card-footer -->
                    {{-- <div class="card-footer">
                        <a href="#" class="card-footer-item justify-content-start"><span><i class="fa fa-plus-circle mr-1"></i> Add Menu Item</span></a>
                    </div><!-- /.card-footer --> --}}
                </div><!-- /.card -->
                <!-- .section-block -->

                {{-- <div class="section-block">
                    <pre id="nestableOutput"></pre>
                </div> --}}
                <hr>
        </div>
        <div class="col-xl-6">
            <form action="/admin/category/store" method="POST">
                @csrf
                    <!-- .fieldset -->
                <fieldset>
                    <legend>Tạo mới danh mục</legend>

                    <div class="form-group">
                        <label for="category_name">Tên danh mục</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" >
                    </div>
                    <div class="form-group">
                        <label for="parent_category">Danh mục cha</label>
                        <select class="custom-select" name="parent_category" id="parent_category" required="">
                            <option value=" "> Choose... </option>
                            @foreach ($categories as $item)
                            <option value="{{ $item->id }}"> {{ $item->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </fieldset><!-- /.fieldset -->
                <hr>
                <button class="btn btn-primary btn-lg btn-block" type="submit">Thêm mới</button>
            </form>
            <div class="row justify-content-center mt-2">
                <div class="col-xl-12">
                    @if (Session::has('error'))
                        <div class="alert alert-danger has-icon" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <div class="alert-icon">
                                <span class="oi oi-bell"></span>
                            </div>
                            {{ Session::get('error') }}
                            {{ Session::forget('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-footer')
<script src="/looper/assets/vendor/nestable2/jquery.nestable.min.js?v={{ now()->timestamp }}"></script>
<script src="/looper/assets/javascript/pages/nestable-demo.js?v={{ now()->timestamp }}"></script>
@endsection
