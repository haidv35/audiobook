@extends('home.layouts.app')
@section('custom-header')
    <link rel="stylesheet" href="/pnotify/dist/PNotifyBrightTheme.css">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.6/plyr.css" />
@endsection
@section('app-main')

    @if (empty($searchProduct))
        @includeWhen(!empty($slider) ? true : false ,'home.layouts.intro',$slider)
        @includeWhen(0 != count($demoLinks) ? true : false,'home.product.try-listening',$demoLinks)
        @includeWhen(0 != count($hotProduct) ? true : false,'home.product.hot-product',$hotProduct)
        @includeWhen(0 != count($newProduct) ? true : false,'home.product.new-product',$newProduct)
        @includeWhen(0 != count($recommendProduct) ? true : false,'home.product.recommend-product',$recommendProduct)
    @endif
    {{-- @include('home.product.brand') --}}
@endsection
@section('custom-footer')
    <script src="https://cdn.plyr.io/3.5.6/plyr.js"></script>
    <script>
        const player1 = new Plyr('#player-1');
        const player2 = new Plyr('#player-2');
        const player3 = new Plyr('#player-3');
    </script>
    <script src="/js/cart.js"></script>
    <script>
        $('#cart').simpleCart();
        $(".login-before_order").bind('click',function(){
            window.location.replace("{{ URL::to('/login') }}");
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#search").on('keyup',function(){
            let search_str = $(this).val();
            $.ajax({
                type: 'POST',
                url: "{{ route('search') }}",
                data: JSON.stringify({'search_str':search_str}),
                dataType: 'JSON',
                success:function(d){
                    console.log(d);
                },
                error:function(xhr,status,error){
                    console.log(xhr);
                }
            });
        });
    </script>
@endsection

