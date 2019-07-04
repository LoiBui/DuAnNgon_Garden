@extends('Layout.index')
@section('title')

@endsection

@section('style')
<link rel="stylesheet" href="{{asset('css/thucdon.css')}}">
@endsection

@section('content')
<div class="header" style="text-align: center;margin-bottom:25px;">
    <h1>Danh Sách Thực Đơn</h1>
</div>
<div class="navbar" style="float:right;margin-bottom: 20px;border-bottom:1px solid blue;">
    <div class="search" style="margin-right:15px;">
        <form class="form-inline" action="{{route('thucdon.search')}}" method="post">
            <select name="sort-price" class="custom-select" id="sortprice" style="margin-right:10px;">
                <option selected>Sắp xếp theo giá</option>
                <option value="1">Tăng dần</option>
                <option value="2">Giảm dần</option>
            </select>
            <input class="form-control mr-sm-2" name="data-search" type="text" placeholder="Search">
            <button class="btn btn-success" type="submit">Search</button>
        </form>
    </div>
    <div class="add">
        <a href="{{route('thucdon.add')}}">
            <button class="btn btn-primary">Thêm mới</button>
        </a>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    @foreach($data as $key=>$value)
    <div class="col-6 col-sm-4 col-md-3 col-lg-3" data-target="{{$value->id}}">
        <div class="main-card mb-3 card"><img width="100%" src="{{asset('images/thucdon/')}}/{{$value->anh}}" alt="Card image cap" class="card-img-top">
            <div class="card-body">
                <div class="information-food">
                    <h5 class="card-title">{{$value->ten}}</h5>
                    <p class="price"><span>{{$value->giatien}} <b>vnđ</b></span></p>

                    <h6 class="card-subtitle">Mã: {{$value->id}}</h6>{{$value->ghichu}}
                </div>
                <br>
                <div class="btn-group btn-group-md">
                    <button class="btn btn-secondary">Chi tiết</button>
                    <button data-toggle="modal" data-target=".bd-example-modal-lg" data-item-id="{{$value->id}}" class=" btn btn-info btn-sua">Sửa</button>
                    <button class="btn btn-danger" type="button" value="destroy/{{$value->id}}" onclick="destroy(this)">Xoá</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="page-links" style="float:right;">
    {{$data->appends(['data-search'=>Request::get('data-search')])->links()}}
</div>
@endsection

@section('modal')
<form action="{{route("thucdon.update")}}" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
    {{ csrf_field() }}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Sửa Thông Tin Món Ăn</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="" id="id" name="id">
                    <div class="form-group">
                        <label for="customFile">Thêm ảnh: </label><br>
                        <input type="file" id="myFile" name="photo1"><br>
                    </div>
                    <div class="form-group">
                        <label for="usr">Tên món ăn:</label>
                        <input type="text" class="form-control" id="tenmonan" name="namefood" required>

                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <label for="">Loại món: </label>
                    <select name="typefood" id="loai" class="custom-select">
                        <option selected>Loại món ăn</option>
                        <option value="1">demo1</option>
                        <option value="2">demo2</option>
                        <option value="3">demo3</option>

                    </select>
                    <div class="form-group">
                        <label for="usr">Giá:</label>
                        <input type="text" class="form-control" id="gia" name="pricefood" required>

                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label for="comment">Ghi chú:</label>
                        <textarea class="form-control" rows="5" id="ghichu" name="notefood"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@section('script')
<script>
    function destroy(btn) {
        if (confirm("Bạn có muốn xoá?") == true) {
            let url = btn.value;
            document.location.href = "thucdon/"+url;
            
        }
    }

    $(document).ready(function(){
        $(document).on('click','btn-sua',function(){
            

        });
    });
</script>
@endsection