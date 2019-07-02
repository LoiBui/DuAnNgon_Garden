@extends('Layout.index')


@section('content')
<div class="nav-bar">
    <div class="danhsach" style="float:right;">
        <a type="button" class="btn btn-primary" href="{{route('thucdon')}}">Danh sách thực đơn</a>
    </div>
</div>
<div class="form-add-container">
    <form action="{{route('thucdon.add')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="customFile">Thêm ảnh: </label><br>
            <input type="file" id="myFile" name="photo1"><br>
        </div>
        <div class="form-group">
            <label for="usr">Tên món ăn:</label>
            <input type="text" class="form-control" id="usr" name="namefood">
        </div>
        <select name="typefood" class="custom-select">
            <option selected>Loại món ăn</option>
            <option value="1">demo1</option>
            <option value="2">demo2</option>
            <option value="3">demo3</option>

        </select>
        <div class="form-group">
            <label for="usr">Giá:</label>
            <input type="text" class="form-control" id="usr" name="pricefood">
        </div>

        <div class="form-group">
            <label for="comment">Ghi chú:</label>
            <textarea class="form-control" rows="5" id="ghichu" name="notefood"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" style="width: 100%;">Thêm</button>
    </form>
</div>
@endsection

@section('js')

@stop