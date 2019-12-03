@extends('home.layouts.app')
@section('meta-tag')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('app-main')
<div class="row justify-content-center mt-5">
    <h3 class="title-page">Giỏ Hàng</h3>
</div>
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
    <div class="container">
        <div class="row">
            <main class="col-md-9">
                <div class="card">
                    <table class="table table-borderless table-shopping-cart">
                        <thead class="text-muted">
                            <tr class="small text-uppercase">
                                <th scope="col">Tên sách</th>
                                <th scope="col" width="120">Số tiền</th>
                                <th scope="col" class="text-right" width="200"> </th>
                            </tr>
                            </thead>
                            <tbody class="cart-products-list">

                            </tbody>

                    </table>

                    <div class="card-body border-top">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12 mt-2">
                                        <a href="/" class="btn btn-light w-100"> <i class="fa fa-chevron-left"></i> Tiếp tục mua sắm </a>

                                    </div>
                                    <div class="col-lg-6 col-sm-12 mt-2">
                                        <div class="row justify-content-center">
                                            <div class="col-6">
                                                <button onclick="resetCart()" class="btn btn-danger w-100"> Xoá tất cả </button>
                                            </div>
                                            <div class="col-6">
                                                <a href="/checkout/{{ Auth::id()}}/{{ Auth::user()->username }}" class="btn btn-primary w-100"> Tiếp tục <i
                                                        class="fa fa-chevron-right"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- card.// -->

            </main> <!-- col.// -->
            <aside class="col-md-3">
                {{-- <div class="card mb-3">
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label>Nhập mã giảm giá</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="" placeholder="Coupon code">
                                    <span class="input-group-append">
                                        <button class="btn btn-primary">Kích hoạt</button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div> <!-- card-body.// -->
                </div> <!-- card .// --> --}}
                <div class="card">
                    <div class="card-body">
                        <dl class="dlist-align">
                            <dt>Thành tiền:</dt>
                            <dd class="text-right" id="subtotal"></dd>
                        </dl>
                        <dl class="dlist-align">
                            <dt>Giảm giá:</dt>
                            <dd class="text-right" id="discount"></dd>
                        </dl>
                        <hr>
                        <h5 class="text-center">Tổng thanh toán:</h5>
                        <p class="text-center h5"><strong class="" id="total"></strong></p>
                    </div> <!-- card-body.// -->
                </div> <!-- card .// -->
            </aside> <!-- col.// -->
        </div>

    </div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

@endsection
@section('custom-footer')
    <script src="/js/current-cart.js"></script>
@endsection
