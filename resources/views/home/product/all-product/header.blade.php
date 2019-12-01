<header class="border-bottom mb-4 pb-3">
    <div class="form-inline">
        <span class="mr-md-auto">Hiển thị {{ $qty  }} sản phẩm </span>
        <select class="mr-2 form-control product-filter">
            <option value="" @if (Request::is('all-product')) selected @endif >Lọc sản phẩm</option>
            <option value="?sort=new_product" @if (Request::get('sort') == 'new_product') selected @endif>Sản phẩm mới nhất</option>
            <option value="?sort=hot_product" @if (Request::get('sort') == 'hot_product') selected @endif>Sản phẩm hot nhất</option>
            <option value="?sort=qty_purchased" @if (Request::get('sort') == 'qty_purchased') selected @endif>Sản phẩm phổ biến nhất</option>
            <option value="?sort=discount_price" @if (Request::get('sort') == 'discount_price') selected @endif>Sản phẩm giá rẻ nhất</option>
        </select>
    </div>
</header><!-- sect-heading -->
