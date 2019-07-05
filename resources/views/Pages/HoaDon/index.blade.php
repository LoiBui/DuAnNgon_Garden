<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <base href="{{asset("")}}" >
    <link href="main.css" rel="stylesheet">
</head>
<body>  
        <button class="btn btn-primary inhoadon" style="    display: block;margin: auto;margin-bottom: 10px;" id="btn">In Hóa Đơn</button>
        <div class="container">
            <div class="row " style="display: flex;justify-content: center;">
                <div class=".col-md-3 .offset-md-3" style="border: 1px solid #0000004a; padding: 24px;" id="printarea">
                    <p class="text-center">Địa Chỉ: Hà Nội</p>
                    <hr>
                    <p>Bàn: <strong>@if($phieuorder->Ban->loaiban == LOAI_BAN_VIP) {{"VIP"}} @else {{"Bàn Thường"}} @endif</strong></p>
                    <p>Thời Gian Vào: <strong>{{$phieuorder->thoigiantao}}</strong></p>
                    <p>Thời Gian Ra: <strong>{{now()}}</strong></p>
                    <p>Số Phiếu: <strong>{{$chitietphieu[0]->idphieuorder}}</strong></p>
                    <p>Số Hóa Đơn: <strong>{{$mahd}}</strong></p>
                        <table class="mb-0 table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên Món</th>
                                    <th>Số Lượng</th>
                                    <th>Đơn Gía</th>
                                    <th>Thành Tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $total = 0 ?>
                                    @foreach($chitietphieu as $key => $value)
                                    <tr>
                                        
                                        <th scope="row">{{$key+1}}</th>
                                        <td>{{$value->ThucDon->ten}}</td>
                                        <td>{{$value->soluong}}</td>
                                        <td>{{$value->ThucDon->giatien}}</td>
                                        <td>{{$value->ThucDon->giatien * $value->soluong}}</td>
                                        <?php $total += $value->ThucDon->giatien * $value->soluong?>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <th><strong>Tổng: </strong></th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><strong>{{number_format($total)}} VNĐ</strong></td>
                                    </tr>
                                    <tr>
                                        <th><strong>Phí Dịch Vụ: </strong></th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><strong>{{number_format($phieuorder->Ban->phuphi)}} VNĐ</strong></td>
                                    </tr>
                                    <tr>
                                        <th><strong>Thành Tiền: </strong></th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><strong>{{number_format($total + $phieuorder->Ban->phuphi)}} VNĐ</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <p>Thu Ngân: Nhân Viên Thu Ngân</p>
                            <p class="text-center">See you again</p>
                </div>
            </div>
        </div>
<script src="js/jquery.js"></script>
<script src="js/printPage.js"></script>

<script>
$(document).ready(()=>{
    $("#btn").click(function () {
    //Hide all other elements other than printarea.
    $("#btn").hide();
    window.print();
    $("#btn").show();
});
});
</script>
</body>
</html>