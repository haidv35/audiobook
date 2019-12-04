@extends('admin.layouts.app')
@section('custom-header')
    <link rel="stylesheet" href="/ckeditor/toolbarconfigurator/lib/codemirror/neo.css">
    <link rel="stylesheet" href="/css/bootstrap-select.css" />
    <style>
        .bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn){
            width: 27.5rem!important;
        }
    </style>
@endsection
@section('app-main')
<main class="app-main">
    <div class="wrapper">
        <div class="page">
            <div class="page-inner">
                <div class="page-section">
                    <div class="d-xl-none">
                        <button class="btn btn-danger btn-floated" type="button" data-toggle="sidebar"><i class="fa fa-th-list"></i></button>
                    </div><!-- .card -->
                    <div class="row justify-content-center">
                        <div class="col-12">
                                <div id="base-style" class="card">
                                        <!-- .card-body -->
                                        <legend class="card-body">
                                        {{ Form::open(array('files'=>'true','method' => 'post','id'=>'upload-form')) }}
                                            @csrf
                                            <fieldset>
                                                <legend>Thêm Mới Sản Phẩm Combo</legend>
                                                <div class="form-group">
                                                    <div class="form-group mt-2">
                                                        {!! Form::label('title', 'Tiêu đề') !!}
                                                        {{ Form::text('title', '', ['class' => 'form-control']) }}
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        {!! Form::label('short_description', 'Giới thiệu ngắn') !!}
                                                        {!! Form::textarea('short_description','',['class' => 'form-control','id'=>'short_description']) !!}
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        {!! Form::label('image_link', 'Hình ảnh') !!}
                                                        <div class="custom-file">
                                                            {!! Form::text('image_link', '', ['class' => 'form-control','placeholder'=>'http://example.com/file.jpg']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        {!! Form::label("regular_price", 'Giá thông thường') !!}
                                                        <div class="input-group">
                                                            {!! Html::decode(Form::label('regular_price','<span class="badge">$</span>',['class'=>'input-group-prepend'])) !!}
                                                            {!! Form::text("regular_price", '', ['class'=>'form-control','placeholder'=>'20,100,500,1000,....']) !!}
                                                        </div>
                                                    </div>

                                                    <div class="form-group mt-2">
                                                        {!! Form::label("regular-price", 'Giá đã giảm') !!}
                                                        <div class="input-group">
                                                            {!! Html::decode(Form::label('discount_price','<span class="badge">$</span>',['class'=>'input-group-prepend'])) !!}
                                                            {!! Form::text("discount_price", '', ['class'=>'form-control','placeholder'=>'20,100,500,1000,....']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-2" id='product-list'>
                                                        <label for="selectpicker">Chọn sản phẩm</label>
                                                        <select class="selectpicker" multiple data-live-search="true">
                                                            @foreach ($products as $product)
                                                                <option value="{{ $product->id }}">{{ $product->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group my-2">
                                                        {!! Form::label('qty_purchased', 'Số lượng sản phẩm đã bán') !!}
                                                        {!! Form::number('qty_purchased', 0,['class' => 'form-control']) !!}
                                                    </div>
                                                    <hr class="mb-4">
                                                    <button class="btn btn-success btn-lg btn-block" type="button" id="btn-submit">Tạo mới</button>
                                                    {{-- {!! Form::submit('Save', ['class'=>"btn btn-primary",'id'=>'btn-submit']) !!} --}}
                                                </div>
                                            </fieldset>

                                        {{ Form::close() }}
                                        </div>
                                    </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>
@endsection
@section('custom-footer')
    <script src="/pnotify/showStackBottomRight.js"></script>
    <script src="/js/bootstrap-select.min.js"></script>
    <script>
        let admin_product_configurable_store = "{{ route('admin.product.storeConfigurable') }}";
        $('select').selectpicker();
    </script>
    <script src="/js/admin/product/create_product_configurable.js"></script>
    <script src="/ckeditor/ckeditor.js"></script>
    <script src="/ckeditor/product-configurable.js"></script>
    <script>
        initSample('short_description');
    </script>
@endsection
