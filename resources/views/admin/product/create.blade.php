@extends('admin.layouts.app')
@section('custom-header')
    <!-- pnotify -->
    <link rel="stylesheet" href="pnotify/dist/PNotifyBrightTheme.css">
    {{-- <style>textarea {resize: none;}</style> --}}
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
                        <div id="base-style" class="card w-50">
                                <!-- .card-body -->
                                <div class="card-body">
                                {{ Form::open(array('files'=>'true','method' => 'post','id'=>'upload-form')) }}
                                    @csrf
                                    <fieldset>
                                        <legend>Thêm Mới Sản Phẩm Thường</legend>
                                        <div class="form-group">
                                            <div class="form-group mt-2">
                                                {!! Form::label('category_id', 'Danh mục') !!}
                                                {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}

                                            </div>
                                            <div class="form-group mt-2">
                                                {!! Form::label('title', 'Tiêu đề') !!}
                                                {{ Form::text('title', '', ['class' => 'form-control']) }}
                                            </div>
                                            <div class="form-group mt-2">
                                                {!! Form::label('short_description', 'Giới thiệu ngắn') !!}
                                                {{ Form::text('short_description', '', ['class' => 'form-control']) }}
                                            </div>
                                            <div class="form-group mt-2">
                                                {!! Form::label('description', 'Mô tả') !!}
                                                {!! Form::textarea('description','',['class' => 'form-control','id'=>'description']) !!}
                                            </div>
                                            <div class="form-group mt-2">
                                                {!! Form::label('image_upload', 'Hình ảnh') !!}
                                                <div class="custom-file">
                                                    {{-- {!! Form::file('image_upload',['class'=>'custom-file-input','multiple'=>'']) !!} --}}
                                                    {!! Form::text('image_link', '', ['class' => 'form-control','placeholder'=>'http://example.com/file.jpg']) !!}
                                                    {{-- <label class="custom-file-label" for="image_upload">Choose file</label> --}}
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                {!! Form::label('demo_link', 'Link demo') !!}
                                                {{ Form::text('demo_link', '', ['class' => 'form-control','placeholder'=>'http://example.com/file.mp3']) }}
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
                                            <div class="form-group mt-2" id='product_links'>
                                                {!! Form::label('product_links', 'Link sản phẩm') !!}
                                                <button type="button" id="add_product_links" class="btn btn-dark mb-1 float-right">Add More</button>
                                                {{ Form::text('product_links[]', '', ['class' => 'form-control mb-1','placeholder'=>'http://example.com/file.mp3']) }}
                                            </div>
                                            <div class="form-group mt-2">
                                                {!! Form::label('', 'Trạng thái hiển thị', ['class' => 'd-block']) !!}
                                                {{-- <div class="custom-control custom-control-inline custom-checkbox">
                                                    {!! Form::checkbox('new_product', '', false, ['class' => 'custom-control-input','id'=>'new_product']) !!}
                                                    {!! Form::label('new_product', 'New Product', ['class'=>'custom-control-label']) !!}
                                                </div> --}}
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span>Sản phẩm mới</span>
                                                    <label class="switcher-control">
                                                        <input type="checkbox" class="switcher-input" id="new_product" name='new_product'> <span class="switcher-indicator"></span>
                                                    </label>
                                                </div>
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span>Sản phẩm bán chạy</span>
                                                    <label class="switcher-control">
                                                        <input type="checkbox" class="switcher-input" id="hot_product"  name='hot_product'> <span class="switcher-indicator"></span>
                                                    </label>
                                                </div>

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
</main>
@endsection

@section('custom-footer')
<script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
<script src="/ckeditor/custom-admin-product.js"></script>
<script src="/pnotify/showStackBottomRight.js"></script>
<script type="text/javascript">
    $("#add_product_links").click(function(e){
        $('#product_links').append('<input class="form-control mb-1" name="product_links[]" type="text" placeholder="http://example.com/file.mp3">');
    });
    let admin_product_store = "{{ route('admin.product.store') }}";
</script>
<script src="/js/admin/product/create.js"></script>
@endsection
