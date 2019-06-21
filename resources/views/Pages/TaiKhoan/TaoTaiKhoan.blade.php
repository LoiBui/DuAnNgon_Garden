@extends('Layout.index')

@section('content')

	<div class="peers ai-s fxw-nw h-100vh">
        <div class="peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style="background-image:url(assets/static/images/bg.jpg)">
            <div class="pos-a centerXY">
                <div class="bgc-white bdrs-50p pos-r" style="width:120px;height:120px"><img class="pos-a centerXY" src="assets/static/images/logo.png" alt=""></div>
            </div>
        </div>
        <div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style="min-width:320px">
            <h2 class="fw-300 c-grey-900 mB-40">Tạo Tài Khoản</h2>
            <form>
                <div class="form-group">
                    <label class="text-normal text-dark">Tên Đăng Nhập</label>
                    <input type="text" class="form-control" placeholder="John Doe">
                </div>
                <div class="form-group">
                    <label class="text-normal text-dark">Mật Khẩu</label>
                    <input type="email" class="form-control" placeholder="name@email.com">
                </div>
                <div class="form-group">
                    <label class="text-normal text-dark">Tên Nhân Viên</label>
                    <input type="text" class="form-control" placeholder="Nhân Viên 3">
                </div>
                <div class="form-group">
                    <label class="text-normal text-dark">Số Điện Thoại</label>
                    <input type="text" class="form-control" placeholder="0939273824">
                </div>
                <div class="form-group">
                    <label class="text-normal text-dark">Số CMND/ Thẻ căn cước</label>
                    <input type="text" class="form-control" placeholder="32423423">
                </div>
                <div class="row">
                	<div class="form-group col-md-4">
	                	<label for="inputState">Giới Tính</label> 
	                	<select id="inputState" class="form-control">
	                		<option selected="selected">Nam</option>
	                		<option>Nữ</option>
	                		<option>Khác</option>
	                	</select>
	                </div>
	                <div class="form-group col-md-8">
					  <label for="comment">Ghi Chú</label>
					  <textarea class="form-control" rows="5" placeholder="Ghi chú về nhân viên này" id="comment"></textarea>
					</div>
                </div>
                
				<hr>
                
                <div class="form-group">
                    <button class="btn btn-primary">Cập Nhật</button>
                </div>
            </form>
        </div>
    </div>

@endsection