<!DOCTYPE HTML>
<html lang="en">
<head>
    @include('home.layouts.header',['title'=>'Tri Thức Nhân Loại'])
</head>
<body>
    @includeIf('home.layouts.header-section',['logo'=>$logo])
    @includeIf('home.layouts.navbar')
    {{-- @include('home.layouts.feature') --}}
    <div class="app-main">
        @yield('app-main')
    </div>

    {{-- @includeIf('home.layouts.footer') --}}
    {!! $footer !!}
    <!-- jQuery -->
    <script src="/js/jquery-2.0.0.min.js" type="text/javascript"></script>
    @include('home.layouts.footer-animate')

    @php
        $timestamp = Carbon\Carbon::now()->timestamp;
    @endphp

    <!-- Bootstrap4 files-->
    <script src="/js/bootstrap.bundle.min.js?v={{ $timestamp }}" type="text/javascript"></script>
    <script type="text/javascript" src="/pnotify/dist/iife/PNotify.js"></script>
    <script type="text/javascript" src="/pnotify/dist/iife/PNotifyButtons.js"></script>
    <script type="text/javascript" src="/pnotify/dist/iife/PNotifyHistory.js"></script>
    <!-- custom javascript -->
    <script type="text/javascript" src="/pnotify/showStackTopRight.js?v={{ $timestamp }}"></script>
    <script src="/js/script.js" type="text/javascript"></script>
    <script type="text/javascript" src="/formatCurrency/jquery.formatCurrency-1.4.0.js"></script>
    <script type="text/javascript" src="/formatCurrency/i18n/jquery.formatCurrency.all.js"></script>

    @auth
        <script src="/js/cart-counter.js?v={{ $timestamp }}" ></script>
    @endauth
    <script src="/js/cart.js?v={{ $timestamp }}"></script>
    @yield('custom-footer')
    <script type="text/javascript" src="/formatCurrency/custom.js?v={{ $timestamp }}"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</body>
</html>
