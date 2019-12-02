<header class="section-header">
    <section class="header-main border-bottom">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-3">
                    <a href="/" class="brand-wrap">
                        <img class="logo" src="{{ $logo }}">
                    </a> <!-- brand-wrap.// -->
                </div>
                <div class="col-lg-5 col-sm-12">
                    <form action="/search" method="GET" class="search">
                        <div class="input-group w-100">
                            <input type="text" name="s" id="s" class="form-control" placeholder="Tìm kiếm">
                        </div>
                    </form>
                </div> <!-- col.// -->
                <div class="col-lg-4 col-sm-6 col-12 d-flex justify-content-center">
                    <div class="widgets-wrap float-md-right">
                        <div class="widget-header  mr-3">
                            <a href="/cart" class="icon icon-sm rounded-circle border" data-toggle="tooltip" data-placement="bottom" title="Xem giỏ hàng"><i
                                    class="fa fa-shopping-cart"></i></a>
                            <span class="badge badge-pill badge-danger notify" id="cart">0</span>
                        </div>
                        <div class="widget-header icontext">
                            <a href="/user" class="icon icon-sm rounded-circle border" data-toggle="tooltip" data-placement="bottom" title="Vào trang người dùng"><i class="fa fa-user"></i></a>
                            <div class="text">
                                @auth
                                    <span class="text-muted">Xin chào</span>
                                    <span style="font-weight:bold">
                                        <a href="/user" data-toggle="tooltip" data-placement="bottom" title="{{ Auth::user()->username }}">{{ Auth::user()->firstname." ".Auth::user()->lastname }}</a>
                                    </span>
                                    <div class="mt-2">
                                        @if (Auth::user()->role === "admin")
                                            <a href="/admin" class="text-success" data-toggle="tooltip" data-placement="bottom" title="Vào trang quản trị">Quản trị | </a>
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
