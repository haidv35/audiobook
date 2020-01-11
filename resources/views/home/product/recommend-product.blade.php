<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-bottom-sm">
    <div class="container">

        <header class="section-heading">
            <a href="/all-product" class="btn btn-outline-primary float-right">Xem tất cả</a>
            <h3 class="section-title">Sản phẩm gợi ý</h3>
        </header><!-- sect-heading -->

        <div class="row">
            @foreach ($recommendProduct as $product)
            <div class="col-lg-3">
                <div class="card card-product-grid">
                    <a href="{{ route('product-details',['id'=>$product->id,'path'=>$product->path])}}" class="img-wrap"> <img
                    src="{{ $product->image }}"> </a>
                    <figcaption class="info-wrap">
                        <a href="{{ route('product-details',['id'=>$product->id,'path'=>$product->path])}}" class="title">{{ $product->title }}</a>
                        {{-- text-truncate --}}
                        <div class="mt-2 row">
                            <div class="col-6">
                                @if ($product->discount_price != 0 && $product->regular_price != 0)
                                    <var class="price">{{ $product->discount_price }}</var> <!-- price-wrap.// -->
                                    <p class="text-muted price" style="text-decoration: line-through;">{{ $product->regular_price }}</p>
                                @else
                                    <var class="" style="color:red;">Miễn Phí</var> <!-- price-wrap.// -->
                                @endif
                            </div>
                            <div class="col-6">
                                @includeIf('home.product.cart-button',['view'=>'recommend-product'])
                            </div>
                            </div>
                    </figcaption>
                </div>
            </div>
            @endforeach
        </div> <!-- row.// -->

    </div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
