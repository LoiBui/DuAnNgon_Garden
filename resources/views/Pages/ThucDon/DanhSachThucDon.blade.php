@extends('Layout.index')

@section('content')


<div class="nav navbar">
    
</div>
<div class="row">
    <div class="col-6 col-sm-6 col-md-3 col-lg 3">
        <div class="card">
            <div class="card-head" style="display: block;margin: auto;width: 90%;padding-top: 10px;">
                <div id="demo" class="carousel slide" data-ride="carousel" style="width: 100%;">
                    <!-- Indicators -->
                    <ul class="carousel-indicators">
                        <li data-target="#demo" data-slide-to="0" class="active"></li>
                        <li data-target="#demo" data-slide-to="1"></li>
                        <li data-target="#demo" data-slide-to="2"></li>
                    </ul>

                    <!-- The slideshow -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://via.placeholder.com/250x300" alt="img1">
                        </div>
                        <div class="carousel-item">
                            <img src="https://via.placeholder.com/250x300" alt="img2">
                        </div>
                        <div class="carousel-item">
                            <img src="https://via.placeholder.com/250x300" alt="img3">
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>
            </div>
            <div class="card-body">body</div>
            <div class="card-footer">footer</div>
        </div>
    </div>
    <div class="col-6 col-sm-6 col-md-3 col-lg 3">
        <div class="card">
            <div class="card-header">header</div>
            <div class="card-body">body</div>
            <div class="card-footer">footer</div>
        </div>
    </div>
    <div class="col-6 col-sm-6 col-md-3 col-lg 3">
        <div class="card">
            <div class="card-header">header</div>
            <div class="card-body">body</div>
            <div class="card-footer">footer</div>
        </div>
    </div>
    <div class="col-6 col-sm-6 col-md-3 col-lg 3">
        <div class="card">
            <div class="card-header">header</div>
            <div class="card-body">body</div>
            <div class="card-footer">footer</div>
        </div>
    </div>
</div>

@endsection