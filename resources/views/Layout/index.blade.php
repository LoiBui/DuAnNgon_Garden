<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Analytics Dashboard - This is an example dashboard created using build-in elements and components.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
<link href="main.css" rel="stylesheet">
</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        @include("Layout.header");

        @include("Layout.setting");

        <div class="app-main">
            @include('Layout.sliderbar')  
            <div class="app-main__outer">
                <div class="app-main__inner">
                        <div id="thongbao">
                            @if(session('thongbao'))
                                <div class="alert alert-success">
                                    <strong>Thông Báo!</strong>
                                    {!!session('thongbao')['msg']!!}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if(count($errors) > 0)
                                @foreach($errors->all() as $er)
                                    <div class="alert alert-danger">
                                        <strong>Thông Báo!</strong>
                                        {!!$er!!}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @yield('content')
                </div>
                @include('Layout.footer')
            </div>
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
<script type="text/javascript" src="assets/scripts/main.js"></script></body>
<script>
setTimeout(function(){ 
		document.getElementById('thongbao').remove();
}, 3000);

</script>
<script src="js/jquery.js"></script>
<script src="js/vue.js"></script>
@yield('script')
</html>

@yield('modal')
