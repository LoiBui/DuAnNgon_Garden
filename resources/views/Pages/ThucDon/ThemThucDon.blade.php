@extends('Layout.index')


@section('content')
<div class="form-add-container">
    <form action="{{route('thucdon.add')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group" style="display: flex; justify-content: center;"> 
            {{-- <label for="customFile">Thêm ảnh: </label><br>
            <input type="file" id="myFile" name="photo1"><br> --}}
            <div class="upload-btn-wrapper">
                <button class="btn1"><p id="text">Chọn Ảnh</p><img class="img-fluid" id="photo" style="height: 100px;" src="https://images.pexels.com/photos/949587/pexels-photo-949587.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt=""></button>
                
                <input type="file" id="myFile" name="photo1" onchange="loadFile(event)"/>
              </div>
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
        <button type="submit" class="btn btn-primary btn-block">Thêm</button>
    </form>
</div>
@endsection


@section('script')
<script>
$("#photo").hide();
var loadFile = function(event) {
    $("#text").hide();
    $("#photo").show();
    var output = document.getElementById('photo');
    output.src = URL.createObjectURL(event.target.files[0]);
};

</script>
@endsection
@section('style')
<style>
.upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
}

.btn1 {
    border: 2px solid gray;
    color: gray;
    background-color: white;
    padding: 8px 20px;
    font-size: 20px;
    font-weight: bold;
    width: 150px;
    height: 150px;
}

.upload-btn-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
}
</style>
@endsection