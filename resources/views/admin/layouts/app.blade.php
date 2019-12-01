<!DOCTYPE html>
<html lang="en">
  @includeIf('admin.layouts.header')
  <body>
    <!-- .app -->
    <div class="app">
    <!--[if lt IE 10]>
    <div class="page-message" role="alert">You are using an <strong>outdated</strong> browser. Please <a class="alert-link" href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</div>
    <![endif]-->
    <!-- .app-header -->
    @includeIf('admin.layouts.navbar')
    <!-- /.app-header -->
    <!-- .app-aside -->
    @includeIf('admin.layouts.sidebar')
    <!-- /.app-aside -->
    <!-- .app-main -->
    <main class="app-main">
        <div class="wrapper">
            <div class="page">
                <div class="page-inner">
                    <header class="page-title-bar">
                        <!-- title and toolbar -->
                        <div class="d-md-flex align-items-md-start">
                            <h1 class="page-title mr-sm-auto"> @yield('title-header') </h1><!-- .btn-toolbar -->
                            <div class="btn-toolbar">
                            @yield('button-header')
                            </div><!-- /.btn-toolbar -->
                        </div><!-- /title and toolbar -->
                    </header>
                    @yield('app-main')
                </div>
            </div>
        </div>
    </main>

    <!-- /.app-main -->
    </div><!-- /.app -->
    <!-- BEGIN BASE JS -->
    @includeIf('admin.layouts.footer')
    @yield('custom-footer')
  </body>
</html>
