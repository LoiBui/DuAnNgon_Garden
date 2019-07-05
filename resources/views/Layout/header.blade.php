<div class="app-header header-shadow">
    <div class="app-header__logo">
        <div class="header__pane ml-auto">
            <div>
                <button id="button" type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                    <input type="text" id="check" value="0" hidden>
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
    </div>    <div class="app-header__content">
        <div class="app-header-right">
            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                    <img width="42" class="rounded-circle" src="assets/images/avatars/1.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="widget-content-left  ml-3 header-user-info">
                            <div class="widget-heading">
                               {{Auth()->guard('web')->user()->tennguoidung}}
                            </div>
                            <div class="widget-subheading">
                                @if(Auth()->guard('web')->user()->quyen == QUYEN_ADMIN)
                                    Admin
                                @elseif(Auth()->guard('web')->user()->quyen == QUYEN_NHA_BEP)
                                    Nhân Viên Nhà Bếp
                                @elseif(Auth()->guard('web')->user()->quyen == QUYEN_PHUC_VU)
                                    Nhân Viên Phục Vụ
                                @else
                                    Nhân Viên Tiếp Tân
                                @endif
                            </div>
                        </div>
                        <div class="widget-content-right header-user-info ml-3">
                            <a href="{{ url(route('admin.dangxuat')) }}" class="btn-shadow p-1 btn btn-primary btn-sm">
                                <i class="fa fa-sign-out-alt fa-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div> 