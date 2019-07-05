@extends('Layout.index')

@section('content')

<div class="masonry-item">
    <div class="bgc-white p-20 bd " style="width: 450px; display: block;margin: 0 auto;">
        <h2 class="c-grey-900">Ghi Nhận Sự Cố</h2>
        <div class="mT-30">
            <form action="" method="">
                <div class="form-group">
                    <div class="form-group" style="float:left;width:80%;">
                        <label for="exampleInputEmail1">Mã Hóa Đơn</label>
                        <input type="text" class="form-control" id="ma-hd" name="mahd" placeholder="Nhập vào mã Hóa Đơn">
                        <small id="emailHelp" class="form-text text-muted">Sự cố ở bàn nào thì nhập Mã hóa đơn ứng với bàn đó</small>

                    </div>
                    <button type="button" name="check-ma-hd" id="check-ma-hd" class="btn btn-primary btn-check-ma-hd" style="margin-left: 10px;margin-top: 31px;">Kiểm tra</button>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label for="comment">Mô Tả</label>
                        <textarea class="form-control" rows="5" placeholder="Khách hàng phàn nàn về vấn đề gì thì phản ánh tại đây." id="comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Xác Nhận</button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $("#check-ma-hd").click(function() {
        var ma_hd = $("#ma-hd").val();
        if (ma_hd != "") {
            $.ajax({
                type: "POST",
                url: "{{route('phanhoi.checkhd')}}",
                data: {
                    "ma_hd": ma_hd
                },
                success: function(data) {
                    console.log(data);
                    if(data.success == true)
                    {
                        console.log("dung r");
                    }
                }
            });
            
        }
    });
</script>
@endsection