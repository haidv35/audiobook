@extends('home.layouts.app')
@section('app-main')
    @includeWhen(isset($searchProduct) ? true : false,'home.product.search-product',$searchProduct)
@endsection
@section('custom-footer')
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
