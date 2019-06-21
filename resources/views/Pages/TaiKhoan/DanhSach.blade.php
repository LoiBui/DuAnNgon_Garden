@extends('Layout.index')

@section('content')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h4 class="card-title">Danh Sách Tài Khoản</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example-api-1" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
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
                                            <tr style="color: #000000bf;" id="user{{$value->id}}">
                                                <td>{{ $value->tendangnhap }}</td>
                                                <td>{{ $value->tennguoidung }}</td>
                                                <td>@if($value->gioitinh) {{ "Nam" }} @elseif(!$value->gioitinh) {{ "Nữ" }} @else {{ "Khác" }} @endif</td>
                                                <td>{{ $value->socmnd }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->sdt }}</td>
                                                <td>
                                                    <div class="qq" style="max-width: 250px;">
                                                        {{ $value->quequan }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="width: 200px;">
                                                        <button onclick="updateUser({{$value->id}})" data-toggle="modal" data-target=".bd-example-modal-lg" type="button" class="btn btn-ft btn-rounded btn-info btnsua"><i class="fa fa-pencil"></i></button>
                                                        <button onclick="xoauser({{$value->id}})" type="button" class="btn btn-ft btn-rounded btn-danger"><i class="fa fa-trash"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                   
                </div>

                {{-- MODAL --}}
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Thay Đổi Thông Tin Tài Khoản</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{-- ---------------------- --}}
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="text-label">Tên Đăng Nhập</label>
                                            <input type="text" id="tendangnhap" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="text-label">Tên Người Dùng</label>
                                            <input type="text" id="tennguoidung" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="text-label" for="gioitinh">Giới Tính</label>
                                            <select class="form-control" id="gioitinh">
                                                <option value="1">Nam</option>
                                                <option value="0">Nữ</option>
                                                <option value="2">Khác</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="text-label">Số Chứng Minh Nhân Dân</label>
                                            <input type="text" id="socmnd" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label class="text-label">Email</label>
                                                <input type="email" id="email" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label class="text-label">Số Điện Thoại</label>
                                                <input type="text" id="sdt" class="form-control" >
                                            </div>
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="text-label">Quê Quán</label>
                                            <input type="text" id="quequan" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                {{-- ----------------------------- --}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" id="update" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            
@endsection


@section('script')
<script>
var current_userId;
function xoauser(id){
    
    Swal.fire({
        title: '',
        text: "Bạn có muốn xóa người dùng này không ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        console.log(this)
        if (result.value) {
            $("#user"+id).remove();
            $.ajax({
                    url : "taikhoan/destroy/" + id,
                    type : "get",
                    dataType:"json",
                    success : function (result){
                        console.log(result)
                        let status = result.err == 0 ? "success" : "error";
                        console.log(status)
                        Swal.fire({
                            position: 'top-end',
                            type: status,
                            title: 'Xóa' + result.msg,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    },
                });
        }
    })
}

function updateUser(id){
    current_userId = id;
}

$(document).on('click','.btnsua',function(){
    let cthis = $(this).parent().parent().parent().children();
    
    let gt = cthis[2].innerHTML.trim();
    if (gt == "Nam") gt = 1
    else if (gt == "Nữ") gt = 0
    else gt = 2;

    $("#tendangnhap").val(cthis[0].innerHTML);
    $("#tennguoidung").val(cthis[1].innerHTML);
    $("#socmnd").val(cthis[3].innerHTML);
    $("#email").val(cthis[4].innerHTML);
    $("#sdt").val(cthis[5].innerHTML);
    $("#quequan").val(cthis.find(".qq")[0].innerText);
    $("#gioitinh").val(gt);

});

$("#update").click(()=>{
    let data = {
        id: current_userId,
        tennguoidung: $("#tennguoidung").val(),
        gioitinh:  $("#gioitinh").val(),
        socmnd:  $("#socmnd").val(),
        email: $("#email").val(),
        sdt: $("#sdt").val(),
        quequan: $("#quequan").val(),
    };
    
    $.ajax({
        url : "taikhoan/update",
        type : "post",
        dataType:"json",
        data : {
            "data": data,
            "_token": "{{ csrf_token() }}"
        },
        success : function (result){
            console.log(result)
        },
        
    });
});
</script>

@endsection

@section('style')

@endsection