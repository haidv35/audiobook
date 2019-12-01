@extends('home.layouts.app')
@section('app-main')
<div class="row" style="margin:5rem 0 10rem 0;">
    <div class="card">
        <div class="row no-gutters">
            <aside class="col-lg-6">
                <article class="gallery-wrap">
                    <div class="img-big-wrap">
                        <div> <a href="javascript:void(0)"><img src="{{ $product->image }}"></a></div>
                    </div>
                    @if ($product->demo_link != '0')
                        <hr>
                        <h4 class="text-center mt-5">Nghe thử</h4>
                        <div class="row justify-content-center">
                            <div class="col-lg-8" style="background:#fff">
                                <iframe width="100%" height="166" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url={{ $product->demo_link }}&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true"></iframe>
                            </div>
                        </div>
                    @endif
                    {{-- <div class="thumbs-wrap">
                        <a href="" class="item-thumb"> <img src="{{ $product->image }}"></a>
                        <a href="" class="item-thumb"> <img src="{{ $product->image }}"></a>
                        <a href="" class="item-thumb"> <img src="{{ $product->image }}"></a>
                    </div> --}}
                </article>
            </aside>
            <main class="col-lg-6 border-left">
                <article class="content-body">

                    <h2 class="title">{{ $product->title }}</h2>


                    <div class="mb-3">
                        <var class="price h4">@if ($product->discount_price != 0) {{ $product->discount_price }} @else {{ $product->regular_price }} @endif</var>
                        <span class="text-muted">/sản phẩm</span>
                    </div> <!-- price-detail-wrap .// -->

                    {!! $product->description->content !!}
                    <div class="rating-wrap my-3">
                        <ul class="rating-stars">
                            <li style="width:100%" class="stars-active">
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </li>
                            <li>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </li>
                        </ul>
                        <p class="label-rating text-success"> <i class="fa fa-clipboard-check"></i> {{ $product->qty_purchased }} người đã mua </p>
                    </div> <!-- rating-wrap.// -->
                    <hr>
                    {{-- <div class="form-row">
                        <div class="form-group col-md flex-grow-0">
                            <label>Số lượng</label>
                            <div class="input-group mb-3 input-spinner">
                                <div class="input-group-prepend">
                                    <button class="btn btn-light" type="button" id="button-minus"> - </button>
                                </div>
                                <input type="text" class="form-control" id="" value="1">
                                <div class="input-group-append">
                                    <button class="btn btn-light" type="button" id="button-plus"> + </button>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    @php
                        $check_ordered = 0;
                    @endphp
                    @if (0 != count($orderedProducts))
                        @foreach ($orderedProducts[0] as $item)
                            @if ($item->product_id === $product->id)
                                @php
                                    $check_ordered = 1;
                                @endphp
                                @if ($item->status == 'paid')
                                    <a href="/user/purchased/{{ $item->product_id }}" class="btn btn-success btn-block">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span class="text">Xem nội dung sản phẩm</span>
                                    </a>
                                @elseif($item->status == 'unpaid')
                                    <a href="/pay/{{ $item->order_code}}" class="btn btn-outline-warning btn-block">Thanh toán <i
                                    class="fa fa-check"></i>
                                    </a>
                                @endif
                            @break
                            @endif
                        @endforeach
                    @endif
                    @if ($check_ordered == 0)
                        <a href="{{ Auth::user() ? '#' : '/login/#!' }}" class="btn btn-outline-primary {{ Auth::user() ? 'add-to-cart' : 'login-before_order' }}" data-id="{{ $product->id }}" data-title="{{ $product->title }}" data-category="{{ $product->category->name }}" data-regular_price="{{ $product->regular_price }}" data-discount_price="{{ $product->discount_price }}">
                            <span class="text">Thêm vào giỏ hàng</span>
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    @endif
                </article> <!-- product-info-aside .// -->
            </main> <!-- col.// -->
        </div> <!-- row.// -->
    </div> <!-- card.// -->
</div>
@endsection
@section('custom-footer')
    <script>
        $(document).ready(function () {
            $('#cart').simpleCart();
            $(".login-before_order").bind('click',function(){
                window.location.replace("{{ URL::to('/login') }}");
            });
        });
    </script>
@endsection
