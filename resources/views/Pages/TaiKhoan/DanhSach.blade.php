@extends('Layout.index')

@section('content')
    <div class="row">
            <div class="col-lg-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">Table responsive</h5>
                            <div class="table-responsive">
                                <table class="mb-0 table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên Đăng Nhập</th>
                                        <th>Tên Người Dùng</th>
                                        <th>Giới Tính</th>
                                        <th>Số CMND</th>
                                        <th>Email</th>
                                        <th>SĐT</th>
                                        <th>Quê Quán</th>
                                        <th>Hành Động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                            @foreach($data as $key => $value)
                                    <tr style="color: #000000bf;" data-target="{{$value->id}}">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $value->tendangnhap }}</td>
                                                <td>
                                                        {{ $value->tennguoidung }}
                                                </td>
                                                <td>
                                                        @if($value->gioitinh == GIOITINH_NAM) {{ "Nam" }} @elseif($value->gioitinh == GIOITINH_NU) {{ "Nữ" }} @else {{ "Khác" }} @endif
                                                </td>
                                                <td>{{ $value->socmnd }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->sdt }}</td>
                                                <td>
                                                        {{ $value->quequan }}
                                                </td>
                                                <td style="display: flex;">
                                                    <a href="taikhoan/destroy/{{$value->id}}" class="mb-2 mr-2 btn btn-danger"><i class="pe-7s-trash" style="font-size: 20px;"> </i></a>
                                                    <a data-toggle="modal" data-target=".bd-example-modal-lg" href="" class="mb-2 mr-2 btn btn-info btnsua"><i class="pe-7s-pen" style="font-size: 20px;"> </i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                                <hr>
                                <div style="float: right;">
                                    {{$data->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    

@endsection

@section('modal')
<form action="{{route("taikhoan.update")}}" method="POST" accept-charset="utf-8">
    @csrf
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Sửa Thông Tin Tài Khoản</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="position-relative form-group">
                            <label for="exampleEmail" class="">Tên Đăng Nhập</label>
                            <input name="username" readonly id="tendangnhap" placeholder="with a placeholder" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="position-relative form-group">
                            <label for="exampleEmail" class="">Tên Người Dùng</label>
                            <input name="tennguoidung" id="tennguoidung" placeholder="with a placeholder" type="text" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <label class="">Giới Tính</label>
                        <select id="gioitinh" name="gioitinh" class="mb-2 form-control">
                            <option value="{{GIOITINH_NAM}}">Nam</option>
                            <option value="{{GIOITINH_NU}}">Nữ</option>
                            <option value="{{GIOITINH_KHAC}}">Khác</option>
                        </select>
                    </div>
                    <div class="col-6">
                            <div  class="position-relative form-group">
                                <label class="">Số Chứng Minh Thư</label>
                                <input id="socmnd" name="socmnd" placeholder="with a placeholder" type="text" class="form-control">
                            </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-6">
                        <div class="position-relative form-group">
                            <label for="exampleEmail" class="">Email</label>
                            <input name="email" id="email" placeholder="with a placeholder" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="position-relative form-group">
                            <label for="exampleEmail" class="">Số Điện Thoại</label>
                            <input name="sdt" id="sdt" placeholder="with a placeholder" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="position-relative form-group">
                            <label for="exampleText" class="">Quê Quán</label>
                            <textarea name="quequan" id="quequan" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p> 
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" id="isSua" name="isSua" value="0">
                        <button id="btnSua" style="margin: 0 auto;display: flex;" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Thay Đổi Mật Khẩu ?
                        </button>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body" style="margin: 5px;">
                            <div class="row">
                                <div class="col-6">
                                    
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail" class="">Mật Khẩu</label>
                                        <input value="" name="password" id="matkhau" placeholder="with a placeholder" type="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail" class="">Xác Nhận Mật Khẩu</label>
                                        <input value="" name="xacnhanmatkhau" id="xacnhanmatkhau" placeholder="with a placeholder" type="password" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        $(document).ready(function() {
            var status = 0;

            $("body").on("click", ".btnsua", function(){
                status = 0;
                $("#id").val($(this).parent().parent()[0].dataset.target);

                var tthis = $(this).parent().parent().children();
               
               
                $("#tendangnhap").val(tthis[1].innerText);
                $("#tennguoidung").val(tthis[2].innerText);

                var gt;
                if (tthis[3].innerText.trim() == "Nam"){
                    gt = {{GIOITINH_NAM}}
                }else if (tthis[3].innerText.trim() == "Nữ"){
                    gt = {{GIOITINH_NU}}
                }else gt = {{GIOITINH_KHAC}}
                $("#gioitinh").val(gt);
                $("#socmnd").val(tthis[4].innerText);
                $("#email").val(tthis[5].innerText);
                $("#sdt").val(tthis[6].innerText);
                $("#quequan").val(tthis[7].innerText);
                
            });

            $("#btnSua").click(function(){
                if (status == 0){
                    $("#isSua").val(1);
                    
                    status = 1;
                }else{
                    $("#isSua").val(2);
                    status = 1;
                }
            });
        });
    </script>   
@endsection