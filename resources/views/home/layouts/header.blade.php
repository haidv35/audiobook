
<meta charset="utf-8">
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="max-age=604800" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta property="og:url" content="{{ url()->full() }}" />
@if(Route::currentRouteName() == 'homepage')
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Sách nói - Tri Thức Nhân Loại" />
    <meta property="og:description" content="Sách nói , Sách kinh doanh , sách dạy con , sách đời sống , sách tư duy , sách giao dục hay nhất mọi thời đại" />
    <meta property="og:image" content="https://trithucnhanloai.com/images/logo.png" />
@endif
@yield('meta-tag')
    <meta property="fb:app_id" content="773358413132697"/>
    <meta property="fb:admins" content="100002405493958"/>

<title>{{ $title }}</title>

<link href="/images/logo.png" rel="shortcut icon" type="image/x-icon">

@yield('custom-header')

@php
    $timestamp = Carbon\Carbon::now()->timestamp;
@endphp
<!-- Bootstrap4 files-->
<link href="/css/bootstrap.css?v={{ $timestamp }}" rel="stylesheet" type="text/css" />

<!-- Font awesome 5 -->
<link href="/font-awesome/css/all.min.css?v={{ $timestamp }}" type="text/css" rel="stylesheet">

<!-- custom style -->
<link href="/css/ui.css?v={{ $timestamp }}" rel="stylesheet" type="text/css" />
<link href="/css/responsive.css?v={{ $timestamp }}" rel="stylesheet" media="only screen and (max-width: 1200px)" />
<link href="/css/style.css?v={{ $timestamp }}" rel="stylesheet" type="text/css" />
<link href="/css/footer-animate.css?v={{ $timestamp }}" rel="stylesheet" type="text/css" />
