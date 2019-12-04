@extends('admin.layouts.app')
@section('title-header')
    Trang Sản Phẩm
@endsection
@section('button-header')
    <a href="{{ route('admin.product.create') }}" class="btn btn-light"><i class="fa fa-plus" aria-hidden="true"></i> <span class="ml-1">Thêm Mới</span></a>
    <a href="{{ route('admin.product.import_export') }}" class="btn btn-light"><i class="oi oi-data-transfer-download"></i> <span class="ml-1">Xuất</span></a>
    <a href="{{ route('admin.product.import_export') }}" class="btn btn-light"><i class="oi oi-data-transfer-upload"></i> <span class="ml-1">Nhập</span></a>
@endsection
@section('app-main')
<div class="card card-fluid">
    <!-- .card-body -->
    <div class="card-body">
        <!-- .form-group -->
        <div class="form-group">
        <!-- .input-group -->
        <div class="input-group input-group-alt">
            <!-- .input-group-prepend -->
            <div class="input-group-prepend">
            <select class="custom-select product-filter">
                <option value="0" @if (Request::is('product')) selected @endif >-</option>
                <option value="?filter=new_product" @if (Request::get('filter') == 'new_product') selected @endif>Sản phẩm mới nhất</option>
                <option value="?filter=hot_product" @if (Request::get('filter') == 'hot_product') selected @endif>Sản phẩm hot nhất</option>
                <option value="?filter=qty_purchased" @if (Request::get('filter') == 'qty_purchased') selected @endif>Sản phẩm phổ biến nhất</option>
                <option value="?filter=discount_price" @if (Request::get('filter') == 'discount_price') selected @endif>Sản phẩm giá rẻ nhất</option>
                <option value="?filter=qty_sold" @if (Request::get('filter') == 'qty_sold') selected @endif>Số lượng bán thật nhiều nhất</option>
            </select>
            </div><!-- /.input-group-prepend -->
            <!-- .input-group -->
            <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><span class="oi oi-magnifying-glass"></span></span>
            </div>
            <form action="/admin/product" method="GET">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm">
            </form>
            </div><!-- /.input-group -->
        </div><!-- /.input-group -->
        </div><!-- /.form-group -->
        <!-- .table-responsive -->
        <div class="text-muted"> Hiển thị 1 tới @if($products->total() < 10) {{ $products->total() % $products->perPage() }} @else {{ $products->perPage() }} @endif trong tổng số {{ $products->total() }}</div>
        <div class="table-responsive">
        <!-- .table -->
        <table class="table">
            <!-- thead -->
            <thead>
            <tr>
                <th colspan="2" style="min-width:320px">
                <div class="thead-dd dropdown">
                    <span class="custom-control custom-control-nolabel custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check-handle">
                            <label class="custom-control-label" for="check-handle"></label>
                        </span>
                        <div class="thead-btn" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fa fa-caret-down"></span>
                    </div>
                    <div class="dropdown-menu">
                    <div class="dropdown-arrow"></div>
                    {{-- <a class="dropdown-item" href="#">Chọn tất cả</a>
                    <a class="dropdown-item" href="#">Bỏ chọn tất cả</a>
                    <div class="dropdown-divider"></div> --}}
                    <a class="dropdown-item" href="#" id="delete-selected">Xoá lựa chọn</a>
                    </div>
                </div>
                </th>
                <th> Bao gồm số sản phẩm </th>
                <th> Giá gốc </th>
                <th> Giá đã giảm </th>
                <th> Số lượng đã bán ảo</th>
                <th> Số lượng đã bán thật</th>
                <th style="width:100px; min-width:100px;"> &nbsp; </th>
            </tr>
            </thead><!-- /thead -->
            <!-- tbody -->
            <tbody>
            <!-- tr -->
            @foreach ($products as $key => $product)
            <tr>
                <td class="align-middle col-checker">
                    <div class="custom-control custom-control-nolabel custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="selectedRow[]" id="selectedRow" data-id="{{ $product->id }}">
                        <label class="custom-control-label" for="selectedRow"></label>
                    </div>
                </td>
                <td class="align-middle">
                    <a href="#" class="tile tile-img mr-1"><img class="img-fluid" src="{{ $product->image }}" alt=""></a> <a href="#">{{ $product->title }}</a>
                </td>
                <td class="align-middle"> {{ $product->count_simple_product }} </td>
                <td class="align-middle"> {{ round($product->regular_price,1) }} </td>
                <td class="align-middle"> {{ round($product->discount_price,1) }} </td>
                <td class="align-middle"> {{ $product->qty_purchased }} </td>
                @php
                    $check = 0;
                @endphp
                @foreach ($paidProductCount as $key => $item)
                    @if($key == $product->id)
                        @php
                            $check = 1;
                        @endphp
                        <td class="align-middle">{{ $item }} </td>
                    @endif
                @endforeach
                @if ($check == 0)
                    <td class="align-middle">0</td>
                @endif
                <td class="align-middle text-right">
                    <a href="{{ route('admin.product.editConfigurable',$product->id) }}" class="btn btn-sm btn-icon btn-secondary">
                        <i class="fa fa-pencil-alt"></i> <span class="sr-only">Edit</span>
                    </a>
                    <button type="button" class="btn btn-sm btn-icon btn-secondary remove-product-btn" data-id="{{ $product->id }}">
                        <i class="far fa-trash-alt"></i> <span class="sr-only">Remove</span>
                    </button>
                </td>
            </tr><!-- /tr -->
            @endforeach
            </tbody><!-- /tbody -->
        </table><!-- /.table -->
        </div><!-- /.table-responsive -->
        <!-- .pagination -->
        <ul class="pagination justify-content-center mt-4">
            {{ $products->links() }}
        </ul><!-- /.pagination -->
    </div><!-- /.card-body -->
</div>

@endsection
@section('custom-footer')
<script src="/js/admin/product/table-dropdown-select.js"></script>
<script src="/js/bootbox.all.min.js"></script>
<script src="/pnotify/showStackBottomRight.js"></script>
<script src="/js/admin/product/home_product_configurable.js"></script>
@endsection
