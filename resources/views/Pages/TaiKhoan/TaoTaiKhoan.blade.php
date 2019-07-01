@extends('Layout.index')

@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body"><h5 class="card-title">Tạo Tài Khoản</h5>
            <form action="{{route("taotaikhoan")}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="position-relative form-group">
                                <label for="exampleAddress" class="">Tên Đăng Nhập</label>
                                <input name="tendangnhap" id="exampleAddress" placeholder="1234 Main St" type="text" class="form-control">
                            </div>
    
                            <div class="position-relative form-group">
                                <label for="examplePassword" class="">Mật Khẩu</label>
                                <input name="matkhau" id="examplePassword" placeholder="password placeholder" type="password" class="form-control">
                            </div>
    
                            <div class="position-relative form-group">
                                <label for="examplePassword" class="">Xác Nhận Mật Khẩu</label>
                                <input name="xacnhanmatkhau" id="examplePassword" placeholder="password placeholder" type="password" class="form-control">
                            </div>
    
                            <div class="position-relative form-group">
                                <label for="exampleAddress" class="">Tên Người Dùng</label>
                                <input name="tennguoidung" id="exampleAddress" placeholder="1234 Main St" type="text" class="form-control">
                            </div>
    
                            <div class="position-relative form-group">
                                <label for="exampleSelect" class="">Giới Tính</label>
                                <select name="gioitinh" id="exampleSelect" class="form-control">
                                    <option value="{{GIOITINH_NAM}}">Nam</option>
                                    <option value="{{GIOITINH_NU}}">Nữ</option>
                                    <option value="{{GIOITINH_KHAC}}">Khác</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="position-relative form-group">
                                <label for="exampleAddress" class="">Số Chứng Minh Nhân Dân</label>
                                <input name="socmnd" id="exampleAddress" placeholder="1234 Main St" type="text" class="form-control">
                            </div>
    
                            <div class="position-relative form-group">
                                <label for="exampleAddress" class="">Quên Quán</label>
                                <input name="quequan" id="exampleAddress" placeholder="1234 Main St" type="text" class="form-control">
                            </div>
    
                            <div class="position-relative form-group">
                                <label for="exampleAddress" class="">Số Điện thoại</label>
                                <input name="sdt" id="exampleAddress" placeholder="1234 Main St" type="text" class="form-control">
                            </div>
    
                            <div class="position-relative form-group">
                                <label for="exampleAddress" class="">Email</label>
                                <input name="email" id="exampleAddress" placeholder="1234 Main St" type="text" class="form-control">
                            </div>

                            <div class="position-relative form-group">
                                <label for="exampleSelect" class="">Quyền</label>
                                <select name="quyen" id="exampleSelect" class="form-control">
                                    <option value="{{TIEPTAN}}">Tiếp Tân</option>
                                    <option value="{{PHUCVU}}">Phục Vụ</option>
                                    <option value="{{NHABEP}}">Nhà Bếp</option>
                                </select>
                            </div>
                        </div>
                    </div>

                        
                    
                    <button class="mt-1 btn btn-primary">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


