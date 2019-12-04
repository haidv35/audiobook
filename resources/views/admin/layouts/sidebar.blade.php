<aside class="app-aside app-aside-expand-md app-aside-light">
    <!-- .aside-content -->
    <div class="aside-content">
        <!-- .aside-header -->
        <header class="aside-header d-block d-md-none">
            <!-- .btn-account -->
            <button class="btn-account" type="button" data-toggle="collapse" data-target="#dropdown-aside"><span
                    class="user-avatar user-avatar-lg"><img src="/looper/assets/images/avatars/unknown-profile.jpg"
                        alt=""></span> <span class="account-icon"><span class="fa fa-caret-down fa-lg"></span></span>
                <span class="account-summary"><span class="account-name">{{ Auth::user()->username }}</span> <span
                        class="account-description">{{ Auth::user()->email }}</span></span></button>
            <!-- /.btn-account -->
            <!-- .dropdown-aside -->
            <div id="dropdown-aside" class="dropdown-aside collapse">
                <!-- dropdown-items -->
                <div class="pb-3">
                    <a class="dropdown-item" href="/admin"><span class="dropdown-icon oi oi-person"></span> Thông tin
                        tài khoản</a> <a class="dropdown-item" href="/admin/logout"><span
                            class="dropdown-icon oi oi-account-logout"></span> Đăng xuất</a>
                </div><!-- /dropdown-items -->
            </div><!-- /.dropdown-aside -->
        </header><!-- /.aside-header -->
        <!-- .aside-menu -->
        <div class="aside-menu overflow-hidden">
            <!-- .stacked-menu -->
            <nav id="stacked-menu" class="stacked-menu">
                <!-- .menu -->
                <ul class="menu">
                    <!-- .menu-item -->
                    <li class="menu-item {{ Request::is('admin') ? 'has-active' : '' }}">
                        <a href="{{ url('/admin') }}" class="menu-link"><span class="menu-icon fas fa-home"></span>
                            <span class="menu-text">Dashboard</span></a>
                    </li><!-- /.menu-item -->
                    <!-- .menu-item -->
                    {{-- <li class="menu-item has-child {{ Request::is('admin/user*') ? 'has-active' : '' }}">
                        <a href="#" class="menu-link"><span class="menu-icon fas fa-user-friends "></span> <span
                                class="menu-text">User</span> </a> <!-- child menu -->
                        <ul class="menu">
                            <li class="menu-item {{ Request::is('admin/user') ? 'has-active' : '' }}">
                                <a href="/admin/user" class="menu-link">Quản lý user</a>
                            </li>
                        </ul><!-- /child menu -->
                    </li><!-- /.menu-item --> --}}
                    <!-- .menu-item -->
                    <li class="menu-item has-child {{ Request::is('admin/product*') ? 'has-active' : '' }}">
                        <a href="#" class="menu-link"><span class="menu-icon fa fa-shopping-cart "></span> <span
                                class="menu-text">Sản Phẩm</span> </a> <!-- child menu -->
                        <ul class="menu">
                            <li class="menu-item {{ Request::is('admin/product') ? 'has-active' : '' }}">
                                <a href="/admin/product" class="menu-link">Xem sản phẩm thường</a>
                            </li>
                            <li class="menu-item {{ Request::is('admin/product/create') ? 'has-active' : '' }}">
                                <a href="/admin/product/create" class="menu-link">Thêm sản phẩm thường</a>
                            </li>
                            <li class="menu-item {{ Request::is('admin/product/configurable') ? 'has-active' : '' }}">
                                <a href="/admin/product/configurable" class="menu-link">Xem sản phẩm combo</a>
                            </li>
                            <li class="menu-item {{ Request::is('admin/product/configurable/create') ? 'has-active' : '' }}">
                                <a href="/admin/product/configurable/create" class="menu-link">Thêm sản phẩm combo</a>
                            </li>
                            <li class="menu-item {{ Request::is('admin/product/import_export') ? 'has-active' : '' }}">
                                <a href="/admin/product/import_export" class="menu-link">Nhập/Xuất</a>
                            </li>
                        </ul><!-- /child menu -->
                    </li><!-- /.menu-item -->
                    <!-- .menu-item -->
                    <li class="menu-item has-child {{ Request::is('admin/category*') ? 'has-active' : '' }}">
                        <a href="#" class="menu-link"><span class="menu-icon fa fa-list-alt "></span> <span
                                class="menu-text">Danh Mục</span> </a> <!-- child menu -->
                        <ul class="menu">
                            <li class="menu-item {{ Request::is('admin/category') ? 'has-active' : '' }}">
                                <a href="/admin/category" class="menu-link">Xem và thêm danh mục</a>
                            </li>
                            <li class="menu-item {{ Request::is('admin/category/import_export') ? 'has-active' : '' }}">
                                <a href="/admin/category/import_export" class="menu-link">Nhập/Xuất</a>
                            </li>
                        </ul><!-- /child menu -->
                    </li><!-- /.menu-item -->

                    <li class="menu-item {{ Request::is('admin/order_list*') ? 'has-active' : '' }}">
                        <a href="/admin/order_list" class="menu-link"><span class="menu-icon fa fa-tasks "></span> <span
                                class="menu-text">Quản Lý Đơn</span> </a> <!-- child menu -->
                    </li>


                    <li class="menu-item has-child {{ Request::is('admin/page*') ? 'has-active' : '' }}">
                        <a href="#" class="menu-link"><span class="menu-icon fas fa-copy "></span> <span
                                class="menu-text">Trang</span> </a> <!-- child menu -->
                        <ul class="menu">
                            <li class="menu-item {{ Request::is('admin/page/slider*') ? 'has-active' : '' }}">
                                <a href="/admin/page/slider" class="menu-link"><span class="menu-text">Slider</span>
                                </a> <!-- child menu -->
                            </li>
                            <li class="menu-item {{ Request::is('admin/page/footer*') ? 'has-active' : '' }}">
                                <a href="/admin/page/footer" class="menu-link"><span class="menu-text">Chân trang</span> </a> <!-- child menu -->
                            </li>
                            <li class="menu-item {{ Request::is('admin/page/about') ? 'has-active' : '' }}">
                                <a href="/admin/page/about" class="menu-link">Giới thiệu</a>
                            </li>
                            <li class="menu-item {{ Request::is('admin/page/tutorial') ? 'has-active' : '' }}">
                                <a href="/admin/page/tutorial" class="menu-link">Hướng dẫn</a>
                            </li>
                            <li class="menu-item {{ Request::is('admin/page/contact') ? 'has-active' : '' }}">
                                <a href="/admin/page/contact" class="menu-link">Liên hệ</a>
                            </li>
                        </ul><!-- /child menu -->
                    </li><!-- /.menu-item -->

                    <li class="menu-item has-child {{ Request::is('admin/settings*') ? 'has-active' : '' }}">
                        <a href="#" class="menu-link"><span class="menu-icon fas fa-cog "></span> <span
                                class="menu-text">Cài đặt</span> </a> <!-- child menu -->
                        <ul class="menu">
                            <li class="menu-item {{ Request::is('admin/settings/payments*') ? 'has-active' : '' }}">
                                <a href="/admin/settings/payments" class="menu-link"><span class="menu-text">Thanh
                                        toán</span> </a> <!-- child menu -->
                            </li>
                            <li class="menu-item {{ Request::is('admin/settings/logo*') ? 'has-active' : '' }}">
                                <a href="/admin/settings/logo" class="menu-link"><span class="menu-text">Logo</span> </a> <!-- child menu -->
                            </li>
                        </ul><!-- /child menu -->
                    </li><!-- /.menu-item -->

                </ul><!-- /.menu -->
            </nav><!-- /.stacked-menu -->
        </div><!-- /.aside-menu -->
        <!-- Skin changer -->
        <footer class="aside-footer border-top p-3">
            <button class="btn btn-light btn-block text-primary" data-toggle="skin">Night mode <i
                    class="fas fa-moon ml-1"></i></button>
        </footer><!-- /Skin changer -->
    </div><!-- /.aside-content -->
</aside>
