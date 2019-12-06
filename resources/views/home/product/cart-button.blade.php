@php
    $checkOrdered = 0;
@endphp
@if(0 != count($orderedProducts))
    @foreach ($orderedProducts as $item)
        @if ($item->product_id === $product->id)
            @php
                $checkOrdered = 1;
            @endphp
            @if ($item->status == 'paid')
                <a href="/user/purchased/{{ $item->product_id }}" class="btn btn-outline-success @if($view === 'all-product') ?  btn-block : '' @else btn-sm  @endif float-right {{Auth::user() ? '' : 'login-before_order' }}">Xem nội dung sản phẩm <i
                class="fa fa-eye"></i></a>
            @elseif($item->status == 'unpaid')
                <a href="/pay/{{ $item->order_code}}" class="btn btn-outline-warning @if($view === 'all-product') ?  btn-block : '' @else btn-sm  @endif float-right {{Auth::user() ? '' : 'login-before_order' }}">Thanh toán <i
                class="fa fa-check"></i></a>
            @endif
            @break
        @endif
    @endforeach
    @if ($checkOrdered == 0)
        <a href="@if (Auth::user()) # @else /login/#! @endif" class="btn btn-outline-primary @if($view === 'all-product') ?  btn-block : '' @else btn-sm  @endif float-right {{Auth::user() ? 'add-to-cart' : 'login-before_order' }}" data-id="{{ $product->id }}" data-title="{{ $product->title }}" data-category="@if($product->category) {{ $product->category->name }} @endif" data-regular_price="{{ $product->regular_price }}" data-discount_price="{{ $product->discount_price }}">Thêm vào giỏ hàng <i
        class="fa fa-shopping-cart"></i></a>
    @endif
@else
    <a href="@if (Auth::user()) # @else /login/#! @endif" class="btn btn-outline-primary @if($view === 'all-product') ?  btn-block : '' @else btn-sm  @endif float-right {{Auth::user() ? 'add-to-cart' : 'login-before_order' }}" data-id="{{ $product->id }}" data-title="{{ $product->title }}" data-category="@if($product->category) {{ $product->category->name }} @endif" data-regular_price="{{ $product->regular_price }}" data-discount_price="{{ $product->discount_price }}">Thêm vào giỏ hàng <i
    class="fa fa-shopping-cart"></i></a>
@endif

