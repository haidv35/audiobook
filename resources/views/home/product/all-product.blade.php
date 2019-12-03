@extends('home.layouts.app')
@section('custom-header')
    <style>
        #short_description-demo {
            height: 90px;
            overflow: hidden;
        }
    </style>
@endsection
@section('app-main')
<div class="container mt-4">
    <div class="row">
        {{-- @include('home.product.all-product.aside') --}}
        <main class="col-md-12">
            @includeIf('home.product.all-product.header',['qty' => $getAllProduct->count()."/".$getAllProduct->total()])
            <div class="row justify-content-center">
                {{ $getAllProduct->links('home.pagination.default') }}
            </div>
            @foreach ($getAllProduct as $key => $product)
                <article class="card card-product-list">
                    <div class="row no-gutters">
                        <aside class="col-md-3">
                            <a href="/product-details/{{$product->id}}" class="img-wrap">
                                {{-- <span class="badge badge-danger"> NEW </span> --}}
                                <img src="{{ $product->image }}" style="margin-top:2rem;">
                            </a>
                        </aside> <!-- col.// -->
                        <div class="col-md-6">
                            <div class="info-main">
                                <a href="{{ route('product-details',['id'=>$product->id,'path'=>$product->path])}}" class="h5 title"> {{ $product->title }}</a>
                                <div id="short_description-demo">
                                    <p>{{ $product->short_description }}</p>
                                </div>
                                <div id="short_description-{{ $product->id }}" class="collapse">
                                    <p>{{ $product->short_description }}</p>
                                </div>
                                <a class="btn short-description" data-toggle="collapse" data-target="#short_description-{{ $product->id }}">Xem thêm &raquo;</a>
                            </div> <!-- info-main.// -->
                        </div> <!-- col.// -->
                        <aside class="col-sm-3">
                            <div class="info-aside">
                                <div class="price-wrap">
                                    @if ($product->discount_price == 0)
                                        <span class="price h5"> {{ $product->regular_price }} </span>
                                    @else
                                        <span class="price h5"> {{ $product->discount_price }} </span>
                                        <del class="price price-old"> {{ $product->regular_price }} </del>
                                    @endif


                                </div> <!-- info-price-detail // -->
                                <br>
                                <p>
                                <a href="{{ route('product-details',['id'=>$product->id,'path'=>$product->path])}}" class="btn btn-primary btn-block"> Chi tiết </a>
                                    @includeIf('home.product.cart-button', ['view' => 'all-product'])
                                </p>
                            </div> <!-- info-aside.// -->
                        </aside> <!-- col.// -->
                    </div> <!-- row.// -->
                </article> <!-- card-product .// -->
            @endforeach

            <div class="row justify-content-center">
                {{ $getAllProduct->links('home.pagination.default') }}
            </div>
        </main> <!-- col.// -->

    </div>
</div>
@endsection
@section('custom-footer')
<script>
    $(document).ready(function () {
        $(".short-description").click(function(){
            $("#short_description-demo").hide();
        });

        $('#cart').simpleCart();
        $(".login-before_order").bind('click',function(){
            window.location.replace("{{ URL::to('/login') }}");
        });
        $(".product-filter").on('change',function(e){
            window.location.replace("/all-product" + $(this).find("option:selected").val());
        });
    });
</script>
@endsection
