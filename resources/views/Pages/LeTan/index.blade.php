@extends('Layout.index')

@section('content')
<ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
	<li class="nav-item">
		<a role="tab" class="nav-link show @if($page == 1) {{"active"}} @endif" id="tab-0" data-toggle="tab" href="#tab-content-0" aria-selected="false">
			<span>Danh Sách Bàn</span>
		</a>
	</li>
	<li class="nav-item">
		<a role="tab" class="nav-link show @if($page == 2) {{"active"}} @endif" id="tab-1" data-toggle="tab" href="#tab-content-1" aria-selected="false">
			<span>Danh Sách Đặt Bàn</span>
		</a>
	</li>
	<li class="nav-item">
		<a role="tab" class="nav-link show @if($page == 3) {{"active"}} @endif" id="tab-2" data-toggle="tab" href="#tab-content-2" aria-selected="true">
			<span>Thanh Toán</span>
		</a>
	</li>
</ul>


{{-- ---------------------- --}}
<div class="tab-content">
	<div class="tab-pane tabs-animation fade @if($page == 1) {{"show active"}} @endif" id="tab-content-0" role="tabpanel">
		<div class="row">
			<div class="col-12">
				<div class="main-card mb-3 card" style="padding: 10px;padding-bottom: 0px;">
					<form class="form-horizontal form-label-left input_mask">
						<div class="row">
							<div class="col-md-2 col-xs-12 form-group">
								<input type="text" class="form-control" name="sochongoi" placeholder="Số chỗ ngồi..." value="{{ Request::get('sochongoi') }}">
							</div>
		
							<div class="col-md-2 col-xs-12 form-group">
								<select name="trangthai" class="form-control">
									<option>{{__('-- Trạng Thái --')}}</option>
									<option>{{__('Trống')}}</option>
									<option>{{__('Đã Đặt')}}</option>
									<option>{{__('Đang Sử Dụng')}}</option>
								</select>
							</div>
		
							<div class="col-md-2 col-xs-12 form-group">
								<form  method="POST" class="form-horizontal form-label-left">
									<button href="{{ url(route('letan')) }}" style="width: 100%" type="submit" class="btn btn-success btn-search"><i class="fa fa-search"></i> {{__('search')}}</button>
								</form>
							</div>
							
							
						</div>
					</form>
				</div>
				<input type="text" id="idbantruoc" value="1" hidden>
			</div>
		
			<div class="col-12">
				<div class="main-card mb-3 card">
					<div class="card-body"><h5 class="card-title">Bàn  </h5>
						
	
						<div class="table-responsive table-hover">
							<table id="dttable" class="mb-0 table">
								<thead>
								<tr>
									<th>ID</th>
									<th>Số Chỗ Ngồi</th>
									<th>Loại Bàn</th>
									<th>Mô Tả</th>
									<th>Trạng Thái</th>
									<th>Hành Động</th>
								</tr>
								</thead>
								<tbody id="table">
									@foreach($data as $key => $value)
									<tr>
									
									
									<input type="hidden" id="ngaydat{{$value['id']}}" value="{{$value["infoOrder"]["ngaydat"]}}">
									<input type="hidden" id="giodat{{$value['id']}}" value="{{$value["infoOrder"]["giodat"]}}">
									<input type="hidden" id="tenkhachhang{{$value['id']}}" value="{{$value["infoOrder"]["tenkhachhang"]}}">
									<input type="hidden" id="trangthai{{$value['id']}}" value="{{$value["infoOrder"]["trangthai"]}}">
									<input type="hidden" id="sdt{{$value['id']}}" value="{{$value["infoOrder"]["sdt"]}}">
									
									
									<td>{{ $value['id'] }}</td>
										<td>{{ $value['sochongoi'] }}</td>
										<td>
											@if( $value['loaiban'] == LOAI_BAN_VIP ) Bàn Vip 
											@else Bàn Thường 
											@endif
										</td>
										<td>{{ $value['mota'] }}</td>
										<td>
											@if( $value['trangthai'] == TRANG_THAI_BAN_TRONG ) Trống 
											@elseif($value['trangthai'] == TRANG_THAI_BAN_DA_DAT) <span>Đã Đặt <a onclick="TaoPhieu({{$value['id']}})" id="ban{{$value['id']}}"
												data-toggle="modal" data-target=".bd-example-modal-lg" style="color: #16aaff;font-weight: bold;cursor: pointer;">Chi Tiết</a> <br><strong>{{$value["infoOrder"]["ngaydat"]}} {{$value["infoOrder"]["giodat"]}}</strong></span> 
											@else Đang Sử Dụng @endif
										</td>
										<td>
											<button onclick='sudung({{$value["id"]}}, "{{$value["infoOrder"]["ngaydat"]}}","{{$value["infoOrder"]["giodat"]}}")' type="button" id="btnchon{{$value["id"]}}" class="btn btn-primary">
												Chọn
											</button>
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
	</div>
	<div class="tab-pane tabs-animation fade @if($page == 2) {{"active show"}} @endif" id="tab-content-1" role="tabpanel">
		<div class="row">

			<div class="col-12">
				<div class="main-card mb-3 card" style="padding: 10px;padding-bottom: 0px;">
					<form class="form-horizontal form-label-left input_mask">
						<div class="row">
							<div class="col-md-4 col-xs-12 form-group">
								<label><input style="margin-top: 10px;" id="myCheck" type="checkbox"></label>
								<input disabled style="width: 90%" id="ngaydat" type="text" class="form-control date-picker pull-right" name="ngaydat" placeholder="Ngày Đặt..." >
							</div>
		
							<div class="col-md-4 col-xs-12 form-group">
								<input type="text" class="form-control" name="sdt" placeholder="SDT Khách Hàng..." value="{{ Request::get('sdt') }}">
							</div>
		
							<div class="col-md-2 col-xs-12 form-group">
								<form  method="POST" class="form-horizontal form-label-left">
									<button href="{{ url(route('letan')) }}" style="width: 100%" type="submit" class="btn btn-success btn-search"><i class="fa fa-search"></i> {{__('search')}}</button>
								</form>
							</div>
							
							
						</div>
					</form>
				</div>
				<input type="text" id="idbantruoc" value="1" hidden>
			</div>
			{{--  --}}
			<div class="col-12">
					<div class="main-card mb-3 card">
						<div class="card-body"><h5 class="card-title">Bàn  </h5>
							
		
							<div class="table-responsive table-hover">
								<table id="dttable" class="mb-0 table">
									<thead>
									<tr>
										<th>ID Bàn</th>
										<th>Tên Khách Hàng</th>
										<th>Số Điện Thoại</th>
										<th>Ngày Đặt</th>
										<th>Giờ Đặt</th>
										<th>Trạng Thái</th>
										<th>Hành Động</th>
									</tr>
									</thead>
									<tbody id="table">
										@foreach($datban as $key => $value)
										<tr>
										
											<td>{{ $value->idban }}</td>
											<td>{{ $value->tenkhachhang }}</td>
											<td>{{ $value->sdt }}</td>
											<td>{{ $value->ngaydat }}</td>
											<td>{{ $value->giodat }}</td>
											<td>
												@if( $value->trangthai == 0 ) Chưa Xác Nhận 
												@elseif($value->trangthai == 1) Đã Xác Nhận
												@else Xong @endif
											</td>
											<td>
												<button @if($value->trangthai == 2) {{"disabled"}} @endif onclick='sudungbandatonline("{{$value->id}}")' type="button" id="btnchononline{{$value->id}}" class="btn btn-primary">
													Chọn
												</button>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
								<hr>
								<div style="float: right;">
									{{$datban->links()}}
								</div>
							</div>
						</div>
					</div>
				</div>
				{{--  --}}
		</div>

	</div>
	<div class="tab-pane tabs-animation fade @if($page == 3) {{"show active"}} @endif" id="tab-content-2" role="tabpanel">
		<div class="row">
			
			{{--  --}}
			<div class="col-12">
					<div class="main-card mb-3 card" style="padding: 10px;padding-bottom: 0px;">
						<form class="form-horizontal form-label-left input_mask">
							<div class="row">
								<div class="col-md-4 col-xs-12 form-group">
									<input type="text" class="form-control" name="idban" placeholder="ID Bàn" value="{{ Request::get('idban') }}">
								</div>
			
								<div class="col-md-2 col-xs-12 form-group">
									<form  method="POST" class="form-horizontal form-label-left">
										<button href="{{ url(route('letan')) }}" style="width: 100%" type="submit" class="btn btn-success btn-search"><i class="fa fa-search"></i> {{__('search')}}</button>
									</form>
								</div>
								
								
							</div>
						</form>
					</div>
				</div>
				{{--  --}}

				<div class="col-12">
						<div class="main-card mb-3 card">
							<div class="card-body"><h5 class="card-title">Bàn  </h5>
								
			
								<div class="table-responsive table-hover">
									<table id="dttable" class="mb-0 table">
										<thead>
										<tr>
											<th>ID Bàn</th>
											<th>Mô Tả</th>
											<th>Số Chỗ Ngồi</th>
											<th>Loại Bàn</th>
											<th>Phụ Phí</th>
											<th>Ghi Chú</th>
											<th>Hành Động</th>
										</tr>
										</thead>
										<tbody id="table">
											@foreach($databan as $key => $value)
											<tr>
											
												<td>{{ $value->id }}</td>
												<td>{{ $value->mota }}</td>
												<td>{{ $value->sochongoi }}</td>
												<td>
													@if( $value->loaiban == LOAI_BAN_VIP ) Bàn Vip 
													@elseif($value->trangthai == LOAI_BAN_THUONG) Bàn Thường
													@endif
												</td>
												<td>{{ $value->phuphi }}</td>
												<td style="max-width: 200px;">{{ $value->ghichu }}</td>
												
												<td>
													<button @click = "chitietphieu({{$value->id}})" data-toggle="modal" data-target="#myModal" type="button" id="btnchononline{{$value->id}}" class="app btn btn-primary">
														Chi Tiết
													</button>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
									<hr>
									<div style="float: right;">
										{{$databan->links()}}
									</div>
								</div>
							</div>
						</div>
					</div>

					{{--  --}}
		</div>
	</div>
</div>

@endsection


@section('modal')
<form action="{{route("letan.datban")}}" method="POST" accept-charset="utf-8">
    @csrf
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Đặt Bàn</h5> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<p>Tên Khách Hàng: <span><strong id="tenkhachhang"></strong></span></p>
				<p>Số Điện Thoại: <span><strong id="sdt"></strong></span></p>
				<p>Ngày Giờ: <span><strong id="ngaygio"></strong></span></p>
			</div>
                
            <div class="modal-footer">
                <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</form>


<!-- The Modal -->
<div class="modal fade" id="myModal">
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
	  
			<!-- Modal Header -->
			<div class="modal-header">
			  <h4 class="modal-title">Chi Tiết Hóa Đơn</h4>
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
	  
			<!-- Modal body -->
			<div class="modal-body" id="appvu1">
					<div class="main-card mb-3 card">
							<div class="card-body"><h5 class="card-title">Chi Tiết Món</h5>
								<table class="mb-0 table table-borderless">
									<thead>
									<tr>
										<th>#</th>
										<th>Tên Món</th>
										<th>Số Lượng</th>
										<th>Giá Tiền</th>
										<th>Thành Tiền</th>
									</tr>
									</thead>
									<tbody>
									<tr v-if = "chitiet.length > 0" v-for = "(value, index) in chitiet">
										<th scope="row">@{{index}}</th>
										<th>@{{value.thucdon.ten}}</th>
										<th>@{{value.soluong}}</th>
										<th>@{{value.thucdon.giatien}}</th>
										<th>@{{value.soluong * value.thucdon.giatien}}</th>
									</tr>
									<tr v-if = "notice == ''">
										<th><strong>Tổng Cộng</strong></th>
										<th></th>
										<th></th>
										<th></th>
										<th><strong>@{{total}} VNĐ</strong></th>
									</tr>
									</tbody>
								</table>
								<p v-if = "notice != ''" style="text-align: center; font-weight: bold;">@{{notice}}</p>
								<img v-if = "isLoading" class="loading" src="icon/loading.gif" alt="">
							</div>
						</div>
			</div>
	  
			<!-- Modal footer -->
			<div class="modal-footer">
			  <button type="button" class="btn btn-primary" data-dismiss="modal">Thanh Toán</button>
			  <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
			</div>
	  
		  </div>
		</div>
	  </div>
@endsection



@section('script')
<script>
	$(document).ready(function(){
		setTimeout(()=>{
			var app = new Vue({
				el: "#appvue",
				data:{
					chitiet: [],
					total: 0,
					isLoading: true,
					notice: ''
				},
				methods: {
					chitietphieu(id){
						this.notice = '';
						this.isLoading = true;
						var cur = this;
						$.ajax({
						type: "GET",
						url: 'letan/getidphieuorderByidBan/'+id,
						data: "check",
						success: function(data){
							if (data.err == 1){
								cur.notice = data.data;
								cur.isLoading = false;
								return;
							}
							cur.chitiet = data.data;
							data.data.forEach(el => {
								cur.total += el.soluong * el.thucdon.giatien;
							});
							console.log(data.data);
							cur.isLoading = false;
						},
						error: (er)=>{
							console.log(er);
						}
					});
					}
				},
			});
		}, 200);
	});
	
</script>
    <script>
        $(document).ready(function(){
			init();
			
		});

		function sudungbandatonline(iddatban){
			console.log(iddatban);
			$.ajax({
				url: 'letan/chuyentranthaibanonline',
				type: 'POST',
				data: {
					iddatban: iddatban
				},
				success: function (result) {
					console.log(result);
					let btn = document.getElementById("btnchononline"+iddatban);
					console.log(btn);
					btn.classList.remove("btn-primary");
					btn.classList.add("btn-warning");
					btn.innerHTML = "Hoàn Thành";
				},
				error: function (e) {
					console.error(e);
				}
			});
		}

		function sudung(idban, ngaydat, giodat){
			console.log(idban);
			$.ajax({
				url: 'letan/chuyentranthaiban',
				type: 'POST',
				data: {
					idban: idban,
					ngaydat: ngaydat,
					giodat: giodat
				},
				success: function (result) {
					console.log(result);
					let btn = document.getElementById("btnchon"+idban);
					console.log(btn);
					btn.classList.remove("btn-primary");
					btn.classList.add("btn-warning");
					btn.innerHTML = "Hoàn Thành";
				},
				error: function (e) {
					console.error(e);
				}
			});
		}


		function TaoPhieu(idBan){
			console.log(idBan);
			document.getElementById("tenkhachhang").innerHTML = document.getElementById("tenkhachhang" + idBan).value;
			document.getElementById("sdt").innerHTML = document.getElementById("sdt" + idBan).value;
			document.getElementById("ngaygio").innerHTML = document.getElementById("giodat" + idBan).value + " " +document.getElementById("ngaydat" + idBan).value;
		}
		function init() {
			init_daterangepicker_single_call();
			HiddenNgayDat();
		}

		function HiddenNgayDat(){
			$('#myCheck').change(function(event) {
                /* Act on the event */
                if(!$(this).is(':checked'))
                {
					$('#ngaydat').attr('disabled', '');
                }
                else
                {
                    $('#ngaydat').removeAttr('disabled');
                }
            });
		}

		function init_daterangepicker_single_call() {
			$('.date-picker').unbind('daterangepicker');
			$('.date-picker').daterangepicker({
				locale: {
					format: 'YYYY-MM-DD'
				},
				singleDatePicker: true,
				singleClasses: "picker_2"
			}, function (start, end, label) {
				console.log(start.toISOString(), end.toISOString(), label);
			});
		}

		
		function TaoPhieu1(idban) {
			
			//document.getElementById("tenkhachhang").value = document.getElementById("#tenkhachhang" + idban).value;
			// console.log(idban);
			// document.getElementById("ban"+document.getElementById("idbantruoc").value+"").style.background = "#FFFFFF";
			// document.getElementById("ban"+idban+"").style.background = "#E0F3FF";
			// document.getElementById("idbantruoc").value = idban;
			// $( "#taophieu" ).click(function() {
			// 	$.ajax({
			// 		url: '/letan/taophieu',
			// 		type: 'GET',
			// 		data: {
			// 			idban: idban,
			// 		},
			// 		success: function (result) {
			// 			if(result.success)
			// 			{
			// 				console.log("sdfsdf");
			// 				$('#thongbao').append('<div id="box_msg_content"><div class="alert alert-success"><strong>Notice! </strong>'+result.msg+'</div></div>');
			// 				// setTimeout(function(){ 
			// 				// 	$('#box_msg_content').remove();
			// 				// }, 10000);
			// 			}
			// 			else{
			// 				// if ($('#box_msg_content')){
			// 				// 	$('#box_msg_content').remove();
			// 				// }
			// 				console.log("a");
			// 				$('#thongbao').append('<div id="box_msg_content"><div class="alert alert-danger"><strong>Notice! </strong>'+result.msg+'</div></div>');
			// 				// setTimeout(function(){ 
			// 				// 	$('#box_msg_content').remove();
			// 				// }, 3000);
							
			// 			}
			// 		},
			// 		error: function (e) {
			// 			console.error(e);
			// 		}
			// 	});
			// });
		}

		
    </script>   
@endsection

@section('style')
<style>
.loading{
	width: 55px;
    display: block;
    margin: auto;
}
</style>
@endsection