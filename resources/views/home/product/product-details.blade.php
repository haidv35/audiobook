@extends('home.layouts.app')
@section('app-main')
<div class="row" style="margin:2rem 0 5rem 0;">
    <div class="col-12">
        <div class="card">
            <div class="row no-gutters">
                <aside class="col-6">
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
                        @if($configurableProductItem != null)
                            <h4 class="text-center bg-success text-light">Combo sách gồm có: </h4>
                            <div class="thumbs-wrap">
                                    @foreach ($configurableProductItem as $item)
                                        <a href="{{ route('product-details',['id'=>$item->simple_products->id,'path'=>$item->simple_products->path])}}" class="item-thumb" target="_blank"> <img src="{{ $item->simple_products->image }}"></a>
                                    @endforeach

                            </div>
                        @endif
                    </article>
                </aside>
                <main class="col-6 border-left">
                    <article class="content-body">

                        <h2 class="title">{{ $product->title }}</h2>

                        <div class="mb-3">
                            <var class="price h4">@if ($product->discount_price != 0) {{ $product->discount_price }} @else {{ $product->regular_price }} @endif</var>
                            <span class="text-muted">/sản phẩm</span>
                        </div> <!-- price-detail-wrap .// -->
                        @if($product->short_description && $configurableProductItem != null)
                            {!! $product->short_description !!}
                        @endif
                        @if($product->description)
                            {!! $product->description->content !!}
                        @endif

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
                            <a href="{{ Auth::user() ? '#' : '/login/#!' }}" class="btn btn-outline-primary {{ Auth::user() ? 'add-to-cart' : 'login-before_order' }}" data-id="{{ $product->id }}" data-title="{{ $product->title }}" data-category="@if(isset($product->category)) {{ $product->category->name }} @endif" data-regular_price="{{ $product->regular_price }}" data-discount_price="{{ $product->discount_price }}">
                                <span class="text">Thêm vào giỏ hàng</span>
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        @endif
                    </article> <!-- product-info-aside .// -->
                </main> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- card.// -->
    </div>
</div>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-6">
            <div class="row">
                <div class="col-12">
                    <h3 class="text-center bg-dark text-light">Bình luận</h3>
                </div>
                <div class="col-12">
                    <div id="fb-root"></div>
                    <div class="fb-comments" data-href="{{ route('product-details',['id'=>$product->id,'path'=>$product->path])}}" data-order-by="time" data-width="100%" data-numposts="10" data-mobile="true"></div>
                </div>
            </div>

        </div>
        <div class="col-6">
            <div class="col-lg-12">
                <h3 class="text-center bg-dark text-light">Có thể bạn quan tâm</h3>
            </div>
            <div class="row">
                @foreach ($recommendProduct as $item)
                <div class="col-lg-6 mt-3">
                    <div href="#" class="list-group-item list-group-item-action" target="_blank">
                        <div class="row">
                            <div class="col-4">
                                <div class="list-group-item-figure rounded-left">
                                    <img src="{{ $item->image}}" alt="" style="height:5rem;width:4rem;">
                                </div>
                            </div>
                            <div class="col-8">
                                {{-- <div class="row"> --}}
                                <p class="text-truncate" data-toggle="tooltip" data-placement="top" title="{{ $item->title }}">{{ $item->title }}</p>

                                {{-- </div> --}}
                                <a name="" id="" class="" href="{{ route('product-details',['id'=>$item->id,'path'=>$item->path])}}" role="button">Xem chi tiết</a>

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-footer')
    <script>
        $(document).ready(function () {
            $('#cart').simpleCart();
            $(".login-before_order").bind('click',function(){
                window.location.replace("{{ URL::to('/login') }}");
            });
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        });
    </script>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v5.0&appId=773358413132697&autoLogAppEvents=1"></script>

@endsection
