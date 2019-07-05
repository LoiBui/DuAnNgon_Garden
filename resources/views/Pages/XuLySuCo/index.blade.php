<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
<base href="{{asset("")}}" >
    <link href="main.css" rel="stylesheet">
    <style>
        body {
  background: url("icon/background.jpg") no-repeat;
}
    </style>
<body>
        <div class="masonry-item">
                <div class=" card bgc-white p-20 bd " style="width: 450px; display: block;margin: 0 auto;padding: 15px;    margin-top: 100px;">
                    <h2 class="c-grey-900">Ghi Nhận Sự Cố</h2>
                    <div class="mT-30">
                        <form action="{{route("phanhoi.phanhoisave")}}" method="POST" id="myfrom">
                            <div class="form-group">
                                <div class="form-group" style="float:left;width:80%;">
                                    <label for="exampleInputEmail1">Mã Hóa Đơn</label>
                                    <input type="text" required class="form-control" id="ma-hd" name="mahd" placeholder="Nhập vào mã Hóa Đơn">
                                    <input type="hidden" name="mahd" value="11" id="mahd">
                                    <small id="emailHelp" class="form-text text-muted">Sự cố ở bàn nào thì nhập Mã hóa đơn ứng với bàn đó</small>
            
                                </div>
                                <button type="button" name="check-ma-hd" id="check-ma-hd" class="btn btn-primary btn-check-ma-hd" style="margin-left: 10px;margin-top: 31px;">Kiểm tra</button>
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <label for="comment">Mô Tả</label>
                                    <textarea name = "noidung" required class="form-control" rows="5" placeholder="Khách hàng phàn nàn về vấn đề gì thì phản ánh tại đây." id="comment"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Xác Nhận</button>
                        </form>
                    </div>
                </div>
            </div>


</body>
<script src="js/jquery.js"></script>
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
                    if (data == 1){
                        alert("Mã Chính Xác");
                        $("#ma-hd").attr("disabled", true);
                        $("#mahd").val($("#ma-hd").val());
                    }else{
                        alert("Mã Không Tồn Tại");
                    }
                }
            });
            
        }
    });

    $(document).ready(()=>{
        $("#myfrom").submit(function(e){
                var attr = $("#ma-hd").attr('disabled');
                if (!(typeof attr !== typeof undefined && attr !== false)) {
                    e.preventDefault();
                    alert("Bạn phải kiểm tra mã hóa đơn trước")
                }
            });
    });
</script>
</script>
</html>
