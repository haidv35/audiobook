@extends('home.layouts.app')
@section('meta-tag')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('app-main')
<div class="row justify-content-center mt-5">
    <h3 class="title-page">Thanh toán</h3>
</div>
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
    <div class="container">
        <div class="row">
            <main class="col-md-12" id="main-checkout">

            </main>
        </div>

    </div>
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
@endsection
@section('custom-footer')
    <script>
        let checkoutUrl = "{{ route('cart.checkout') }}";
    </script>
    <script src="/js/checkout.js"></script>
@endsection
