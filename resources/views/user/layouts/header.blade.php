<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!-- End Required meta tags -->
    <!-- Begin SEO tag -->
    <title> Trang người dùng </title>
    <meta property="og:title" content="Dashboard">
    <meta name="author" content="dinghi">
    <meta property="og:locale" content="en_US">
    <meta name="description" content="User Panel">
    <meta property="og:description" content="User Panel">
    <link rel="canonical" href="#">
    <meta property="og:url" content="#">
    <meta property="og:site_name" content="User Panel">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    @yield('meta-tag')
    <script type="application/ld+json">
      {
        "name": "User",
        "description": "User",
        "author":
        {
          "@type": "dinghi",
          "name": "dinghi"
        },
        "@type": "WebSite",
        "url": "",
        "headline": "Dashboard",
        "@context": "http://schema.org"
      }
    </script><!-- End SEO tag -->
    <!-- FAVICONS -->
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/looper/assets/apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('/looper/assets/favicon.ico') }}">
    <meta name="theme-color" content="#3063A0"><!-- End FAVICONS -->
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet"><!-- End GOOGLE FONT -->
    <!-- BEGIN PLUGINS STYLES -->
    <link rel="stylesheet" href="{{ asset('/looper/assets/vendor/open-iconic/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/looper/assets/vendor/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('/looper/assets/vendor/flatpickr/flatpickr.min.css') }}"><!-- END PLUGINS STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" href="{{ asset('/looper/assets/stylesheets/theme.min.css') }}" data-skin="default">
    <link rel="stylesheet" href="{{ asset('/looper/assets/stylesheets/theme-dark.min.css') }}" data-skin="dark">
    <link rel="stylesheet" href="{{ asset('/looper/assets/stylesheets/custom.css') }}"><!-- Disable unused skin immediately -->
    @yield('custom-header')
    <script>
      var skin = localStorage.getItem('skin') || 'default';
      var unusedLink = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
      unusedLink.setAttribute('rel', '');
      unusedLink.setAttribute('disabled', true);
    </script><!-- END THEME STYLES -->
</head>
