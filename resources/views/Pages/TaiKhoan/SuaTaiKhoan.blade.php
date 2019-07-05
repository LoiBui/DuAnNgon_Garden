<div class="peers ai-s fxw-nw h-100vh csr" style="height: 500px;">
    <div class="peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style="background-image:url(assets/static/images/bg.jpg); border-radius: 5px;">
        <div class="pos-a centerXY">
            <div class="bgc-white bdrs-50p pos-r" style="width:120px;height:120px"><img class="pos-a centerXY" src="assets/static/images/logo.png" alt=""></div>
        </div>
    </div>
    <div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r cgd" style="min-width:320px">
        <h2 class="fw-300 c-grey-900 mB-40">Sửa Tài Khoản</h2>
        <form>
            <div class="form-group">
                <label class="text-normal text-dark">Tên Đăng Nhập</label>
                <input type="text" class="form-control" placeholder="nhom3" value="nhom3_ok">
            </div>
            <div class="checkbox checkbox-circle checkbox-info peers ai-c mB-15"><input type="checkbox" id="inputCall1" name="inputCheckboxesCall" class="peer"> <label for="inputCall1" class="peers peer-greed js-sb ai-c"><span class="peer peer-greed">Sửa Mật Khẩu</span></label></div>
            <div class="form-group">
                <label class="text-normal text-dark">Mật Khẩu</label>
                <input type="password" disabled class="form-control" placeholder="*********" >
            </div>
            <div class="form-group">
                <label class="text-normal text-dark">Tên Nhân Viên</label>
                <input type="text" class="form-control" placeholder="xxxxxxxxx" value="Nhân Viên Nhóm 3">
            </div>
            <div class="form-group">
                <label class="text-normal text-dark">Số Điện Thoại</label>
                <input type="text" class="form-control" placeholder="0xxxxxxxxxx" value="06996969696">
            </div>
            <div class="form-group">
                <label class="text-normal text-dark">Số CMND/ Thẻ căn cước</label>
                <input type="text" class="form-control" placeholder="32432432423" value="0328132142">
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="inputState">Giới Tính</label> 
                    <select id="inputState" class="form-control">
                        <option selected="selected">Nam</option>
                        <option>Nữ</option>
                        <option>Khác</option>
                    </select>
                </div>
                <div class="form-group col-md-7">
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

<style>
.scr{
    scroll-behavior: smooth;
}
</style>