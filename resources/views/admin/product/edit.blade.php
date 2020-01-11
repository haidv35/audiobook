@extends('admin.layouts.app')
@section('custom-header')
    <!-- pnotify -->
    <link rel="stylesheet" href="/pnotify/dist/PNotifyBrightTheme.css">
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
                        <div id="base-style" class="card">
                                <!-- .card-body -->
                                <div class="card-body">
                                {{ Form::open(array('files'=>'true','method' => 'post','id'=>'upload-form')) }}
                                    @csrf
                                    <fieldset>
                                        <legend>Chỉnh sửa</legend>
                                        <div class="form-group">
                                            <div class="form-group mt-2">
                                                {!! Form::label('category_id', 'Danh mục') !!}

                                                <select name="category_id" id="" class= 'form-control'>
                                                    <option value="{{ $product->category_id }}">{{ $product->category->name }}</option>
                                                    @foreach ($categories as $key => $value)
                                                        @if ($key != $product->category_id && $value != $product->category->name)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                        @endif
                                                    @endforeach

                                                </select>
                                                {{-- {!! Form::select('category_id',dd($categories[$product->category_id]) , null, ['class' => 'form-control']) !!} --}}

                                            </div>
                                            <div class="form-group mt-2">
                                                {!! Form::label('title', 'Tiêu đề') !!}
                                                {{ Form::text('title', $product->title, ['class' => 'form-control']) }}
                                            </div>
                                            <div class="form-group mt-2">
                                                {!! Form::label('short_description', 'Giới thiệu ngắn') !!}
                                                {{ Form::text('short_description', $product->short_description, ['class' => 'form-control']) }}
                                            </div>
                                            <div class="form-group mt-2">
                                                {!! Form::label('description', 'Mô tả') !!}
                                                {!! Form::textarea('description',$product->description->content,['class' => 'form-control','id'=>'description']) !!}
                                            </div>
                                            <div class="form-group mt-2">
                                                {!! Form::label('image_link', 'Hình ảnh') !!}
                                                <div class="col-xl-4 col-lg-5 col-sm-6">
                                                    <!-- .card -->
                                                    <div class="card card-figure">
                                                        <!-- .card-figure -->
                                                        <figure class="figure">
                                                            <!-- .figure-img -->
                                                            <div class="figure-attachment">
                                                                @if ($product->image != "")
                                                                    <img src="{{ $product->image  }}" alt="Card image cap">
                                                                <p style="color:red;">Chưa có ảnh</p>
                                                                {!! Form::hidden('image_link', $product->image) !!}
                                                                @endif
                                                            </div><!-- /.figure-img -->
                                                        </figure><!-- /.card-figure -->
                                                    </div><!-- /.card -->
                                                </div>
                                                {{-- <div class="custom-file"> --}}
                                                    {{-- {!! Form::file('image_upload',['class'=>'custom-file-input','multiple'=>'']) !!} --}}
                                                    {{-- <label class="custom-file-label" for="image_upload">Chọn tệp</label> --}}
                                                @if ($product->image != "")
                                                    {!! Form::text('image_link', $product->image, ['class'=>'form-control']) !!}
                                                @else
                                                    {!! Form::text('image_link', '', ['class'=>'form-control']) !!}
                                                @endif
                                                {{-- </div> --}}
                                            </div>
                                            <div class="form-group mt-2">
                                                {!! Form::label('demo_link', 'Link demo') !!}
                                                {{ Form::text('demo_link', $product->demo_link, ['class' => 'form-control']) }}
                                            </div>
                                            <div class="form-group mt-2">
                                                {!! Form::label("regular_price", 'Giá thông thường') !!}
                                                <div class="input-group">
                                                    {!! Html::decode(Form::label('regular_price','<span class="badge">$</span>',['class'=>'input-group-prepend'])) !!}
                                                    {!! Form::text("regular_price", $product->regular_price, ['class'=>'form-control','placeholder'=>'20,100,500,1000,....']) !!}
                                                </div>
                                            </div>

                                            <div class="form-group mt-2">
                                                {!! Form::label("discount-price", 'Giá đã giảm') !!}
                                                <div class="input-group">
                                                    {!! Html::decode(Form::label('discount_price','<span class="badge">$</span>',['class'=>'input-group-prepend'])) !!}
                                                    {!! Form::text("discount_price", $product->discount_price, ['class'=>'form-control','placeholder'=>'20,100,500,1000,....']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group mt-2" id="product_links">
                                                {!! Form::label('product_link', 'Link sản phẩm') !!}
                                                <button type="button" id="add_product_links" class="btn btn-dark mb-1 float-right">Thêm</button>
                                                @foreach ($product_links as $key => $product_link)
                                                    {{ Form::hidden('product_links_id[]', $product_link->id) }}
                                                    {{ Form::text('product_links[]',$product_link->content, ['class' => 'form-control mb-1']) }}
                                                @endforeach
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
                                                        <input type="checkbox" class="switcher-input" id="new_product" name='new_product' {{ ($product->new_product == 1) ? "checked" : "" }}> <span class="switcher-indicator"></span>
                                                    </label>
                                                </div>
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span>Sản phẩm bán chạy</span>
                                                    <label class="switcher-control">
                                                        <input type="checkbox" class="switcher-input" id="hot_product"  name='hot_product' {{ ($product->hot_product == 1) ? "checked" : "" }}> <span class="switcher-indicator"></span>
                                                    </label>
                                                </div>

                                            </div>
                                            <div class="form-group my-2">
                                                {!! Form::label('qty_purchased', 'Số lượng sản phẩm đã bán') !!}
                                                {!! Form::number('qty_purchased', $product->qty_purchased,['class' => 'form-control']) !!}
                                            </div>
                                            <hr class="mb-4">
                                            <button class="btn btn-success btn-lg btn-block" type="button" id="btn-submit">Cập nhật</button>
                                            {{-- {!! Form::submit('Save', ['class'=>"btn btn-primary"]) !!} --}}
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
    let admin_product_update = "{{ route('admin.product.update',$product->id) }}";
</script>
<script src="/js/admin/product/edit.js"></script>
@endsection
