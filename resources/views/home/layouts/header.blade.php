
<meta charset="utf-8">
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="max-age=604800" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta property="og:url" content="url bài viết" />
<meta property="og:type" content="website" />
<meta property="og:title" content="Tiêu đề" />
<meta property="og:description" content="Giới thiệu" />
<meta property="og:image" content="hình ảnh" />
<meta property="fb:app_id" content="773358413132697"/>
<meta property="fb:admins" content="100002405493958"/>
@yield('meta-tag')
<title>{{ $title }}</title>

<link href="/images/logo.png" rel="shortcut icon" type="image/x-icon">

@yield('custom-header')
<!-- Bootstrap4 files-->
<link href="/css/bootstrap.css" rel="stylesheet" type="text/css" />

<!-- Font awesome 5 -->
<link href="/font-awesome/css/all.min.css" type="text/css" rel="stylesheet">

<!-- custom style -->
<link href="/css/ui.css" rel="stylesheet" type="text/css" />
<link href="/css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />
<link href="/css/style.css" rel="stylesheet" type="text/css" />
<link href="/css/footer-animate.css" rel="stylesheet" type="text/css" />
