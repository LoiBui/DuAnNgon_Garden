@extends('Layout.index')

@section('content')

	<div class="row">
		<div class="col-md-6">
			<div class="bgc-white bd bdrs-3 p-20 mB-20">
	            <h4 class="c-grey-900 mB-20">Danh Sách Bàn Ăn</h4>
	            <table id="dataTable" class="table table-bordered" cellspacing="0" width="100%">
	                <thead>
	                    <tr>
	                        <th>STT</th>
	                        <th>Mã Bàn</th>
	                        <th>Thời Gian</th>
	                        <th>Trạng Thái</th>
	                        <th>Hành Động</th>
	                    </tr>
	                </thead>
	                
	                <tbody>
	                    <tr>
	                        <td>1</td>
	                        <td>B0213</td>
	                        <td>1 Giờ trước</td>
	                        <td>Đang Đợi</td>
	                        <td><button class="btn btn-primary"><i class="ti-plus"></i></button></td>
	                    </tr>
	                    <tr>
	                        <td>2</td>
	                        <td>B03128</td>
	                        <td>10 Phút trước</td>
	                        <td>Đang Làm</td>
	                        <td><button class="btn btn-primary"><i class="ti-plus"></i></button></td>
	                    </tr>
	                    <tr>
	                        <td>3</td>
	                        <td>B894623</td>
	                        <td>5 Phút trước</td>
	                        <td>Đang Làm</td>
	                        <td><button class="btn btn-primary"><i class="ti-plus"></i></button></td>
	                    </tr>
	                    <tr>
	                        <td>4</td>
	                        <td>B232819</td>
	                        <td>2 Phút trước</td>
	                        <td>Đang Đợi</td>
	                        <td><button class="btn btn-primary"><i class="ti-plus"></i></button></td>
	                    </tr>
	                    <tr>
	                        <td>5</td>
	                        <td>B038219</td>
	                        <td>Bây giờ</td>
	                        <td>Đang Làm</td>
	                        <td><button class="btn btn-primary"><i class="ti-plus"></i></button></td>
	                    </tr>
	                    
	                </tbody>
	            </table>
	        </div>
		</div>
		<div class="col-md-6">
			<div class="bgc-white bd bdrs-3 p-20 mB-20">
	            <h4 class="c-grey-900 mB-20">Mã Bàn: 001</h4>
	            <br><br>
	            <table id="dataTable" class="table table-bordered" cellspacing="0" width="100%">
	                <thead>
	                    <tr>
	                        <th>Tên Món Ăn</th>
	                        <th>Số Lượng</th>
	                        <th>Ghi Chú</th>
	                        <th>Trạng Thái</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <tr>
	                        <td>Nem Cua Bề Bề</td>
	                        <td>1</td>
	                        <td></td>
	                        <td>Đang làm</td>
	                    </tr>
	                    <tr>
	                        <td>Nộm Đu Đủ</td>
	                        <td>2</td>
	                        <td>Không cho ớt</td>
	                        <td>Đang làm</td>
	                    </tr>
	                    <tr>
	                        <td>Gà luộc</td>
	                        <td>1</td>
	                        <td></td>
	                        <td>Hoàn Thành</td>
	                    </tr>
	                    <tr>
	                        <td>Chim câu nướng</td>
	                        <td>2</td>
	                        <td>Không tẩm mật ong</td>
	                        <td>Đang làm</td>
	                    </tr>
	                    <tr>
	                        <td>Gà nướng Hà Nội</td>
	                        <td>1</td>
	                        <td></td>
	                        <td>Hoàn thành</td>
	                    </tr>
	                </tbody>
	            </table>
	            {{-- <button class="btn btn-danger">Hủy</button> --}}
	            <button class="btn btn-primary">Hoàn Thành</button>
	        </div>
		</div>
	</div>

@endsection