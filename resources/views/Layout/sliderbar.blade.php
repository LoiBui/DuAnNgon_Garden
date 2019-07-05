<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                    
                </span>
            </button>
        </span>
    </div>    
    <div class="scrollbar-sidebar">
        <div class="text-center">
            <img id="logo" style="width: 150px;transition: 1s;" class="rounded-circle" src="assets/images/logo.png" alt="">
        </div>
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    <a href="{{ url(route('dashboard')) }}" class="mm-active">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                    </a>
                </li>
                <li class="app-sidebar__heading">Quản Lý</li>
                <li>
                    <a href="taikhoan">
                        <i class="metismenu-icon pe-7s-diamond"></i>
                        Tài Khoản
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-car"></i>
                        Bàn
                        {{-- <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i> --}}
                    </a>
                    {{-- <ul>
                        <li>
                            <a href="components-tabs.html">
                                <i class="metismenu-icon">
                                </i>Danh Sách
                            </a>
                        </li>
                    </ul> --}}
                </li>
                <li  >
                    <a href="tables-regular.html">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Tables
                    </a>
                </li>
                <li class="app-sidebar__heading">Lễ Tân</li>
                <li>
                    <a href="{{ url(route('letan')) }}">
                        <i class="metismenu-icon pe-7s-graph2">
                        </i>Đặt Bàn
                    </a>
                </li>
                <li class="app-sidebar__heading">Phục Vụ</li>
                <li>
                    <a href="{{ url(route('nvphucvu')) }}">
                        <i class="metismenu-icon pe-7s-graph2">
                        </i>Đặt Món
                    </a>
                </li>
                <li class="app-sidebar__heading">Nhà Bếp</li>
                <li>
                    <a href="{{ url(route('nhabep')) }}">
                        <i class="metismenu-icon pe-7s-graph2">
                        </i>ChartJS
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>  