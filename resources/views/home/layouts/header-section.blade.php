<header class="section-header">
    <section class="header-main border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2 col-6">
                    <a href="/" class="brand-wrap">
                        <img class="logo" src="{{ $logo }}">
                    </a> <!-- brand-wrap.// -->
                </div>
                <div class="col-lg-6 col-sm-12">
                    <form method="GET" class="search">
                        <div class="input-group w-100">
                            <input type="text" name="search" id="search" class="form-control" placeholder="Tìm kiếm">
                        </div>
                    </form>
                </div> <!-- col.// -->
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="widgets-wrap float-md-right">
                        <div class="widget-header  mr-3">
                            <a href="/cart" class="icon icon-sm rounded-circle border"><i
                                    class="fa fa-shopping-cart"></i></a>
                            <span class="badge badge-pill badge-danger notify" id="cart">0</span>
                        </div>
                        <div class="widget-header icontext">
                            <a href="/user" class="icon icon-sm rounded-circle border"><i class="fa fa-user"></i></a>
                            <div class="text">
                                @auth
                                    <span class="text-muted">Xin chào</span>
                                    <span style="font-weight:bold">
                                        <a href="/user">{{ Auth::user()->firstname." ".Auth::user()->lastname }}</a>
                                    </span>
                                    <div class="mt-2">
                                        @if (Auth::user()->role === "admin")
                                            <a href="/admin" class="text-success">Quản trị | </a>
                                        @endif
                                        <a href="/logout" class="text-danger">Đăng xuất</a>
                                    </div>
                                @endauth
                                @guest
                                    <div>
                                        <a href="/login">Đăng nhập</a> |
                                        <a href="/register"> Đăng kí</a>
                                    </div>
                                @endguest
                            </div>
                        </div>
                    </div> <!-- widgets-wrap.// -->
                </div> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- container.// -->
    </section> <!-- header-main .// -->
</header> <!-- section-header.// -->
