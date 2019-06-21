@extends('Layout.index')

@section('content')

<div class="masonry-item">
    <div class="bgc-white p-20 bd " style="width: 450px; display: block;margin: 0 auto;">
        <h2 class="c-grey-900">Ghi Nhận Sự Cố</h2>
        <div class="mT-30">
            <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Mã Hóa Đơn</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập vào mã Hóa Đơn"> <small id="emailHelp" class="form-text text-muted">Sự cố ở bàn nào thì nhập Mã hóa đơn ứng với bàn đó</small></div>
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