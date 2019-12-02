@extends('home.layouts.app')
@section('app-main')
    @includeWhen(isset($searchProduct) ? true : false,'home.product.search-product',$searchProduct)
@endsection
