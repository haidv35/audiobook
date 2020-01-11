@extends('admin.layouts.app')
@section('custom-header')
    <link rel="stylesheet" href="/pnotify/dist/PNotifyBrightTheme.css">
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
                                    <div class="card-body">
                                    {{ Form::open(array('files'=>'true','method' => 'post','id'=>'upload-form')) }}
                                        @csrf
                                        <fieldset>
                                            <legend>Chỉnh sửa</legend>
                                            <div class="form-group">
                                                <div class="form-group mt-2">
                                                    {!! Form::label('title', 'Tiêu đề') !!}
                                                    {{ Form::text('title', $product->title, ['class' => 'form-control']) }}
                                                </div>
                                                <div class="form-group mt-2">
                                                    {!! Form::label('short_description', 'Giới thiệu ngắn') !!}
                                                    {!! Form::textarea('short_description',$product->short_description,['class' => 'form-control','id'=>'short_description']) !!}
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
                                                <div class="form-group mt-2" id='product-list'>
                                                    <select class="selectpicker" multiple data-live-search="true">
                                                        @foreach ($all_simple_product as $product_simple_item)
                                                            @php $check = 0;  @endphp
                                                            @foreach ($product->product_configurable_id as $product_configurable_item)
                                                                @if($product_configurable_item->product_simple_id == $product_simple_item->id)
                                                                    <option value="{{ $product_simple_item->id }}" selected>{{ $product_simple_item->title }}</option>
                                                                    @php $check = 1 @endphp
                                                                    @break
                                                                @endif
                                                            @endforeach
                                                            @if($check == 0) <option value="{{ $product_simple_item->id }}">{{ $product_simple_item->title }}</option> @endif
                                                        @endforeach
                                                    </select>
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
                                                <div class="form-group my-2">
                                                    {!! Form::label('qty_purchased', 'Số lượng sản phẩm đã bán') !!}
                                                    {!! Form::number('qty_purchased', $product->qty_purchased,['class' => 'form-control']) !!}
                                                </div>
                                                <hr class="mb-4">
                                                <button class="btn btn-success btn-lg btn-block" type="button" id="btn-submit">Cập Nhật</button>
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
<script type="text/javascript">
    let update_product_configurable_url = "{{ route('admin.product.updateConfigurable',$product->id) }}";
    $('select').selectpicker();
</script>
<script src="/js/admin/product/edit_product_configurable.js"></script>
<script src="/ckeditor/ckeditor.js"></script>
<script src="/ckeditor/product-configurable.js"></script>
<script>
    initSample('short_description');
</script>
@endsection
