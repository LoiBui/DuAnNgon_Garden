@extends('Layout.index')

@section('content')
<ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
	<li class="nav-item">
		<a role="tab" class="nav-link show active" id="tab-0" data-toggle="tab" href="#tab-content-0" aria-selected="false">
			<span>Danh Sách Bàn</span>
		</a>
	</li>
	<li class="nav-item">
		<a role="tab" class="nav-link show" id="tab-1" data-toggle="tab" href="#tab-content-1" aria-selected="false">
			<span>Thanh Toán</span>
		</a>
	</li>
	<li class="nav-item">
		<a role="tab" class="nav-link show" id="tab-2" data-toggle="tab" href="#tab-content-2" aria-selected="true">
			<span>Basic</span>
		</a>
	</li>
</ul>


{{-- ---------------------- --}}
<div class="tab-content">
	<div class="tab-pane tabs-animation fade active show" id="tab-content-0" role="tabpanel">
		<div class="row">
			<div class="col-12">
				<div class="main-card mb-3 card" style="padding: 10px;padding-bottom: 0px;">
					<form class="form-horizontal form-label-left input_mask">
						<div class="row">
							<div class="col-md-2 col-xs-12 form-group">
								<input type="text" class="form-control" name="sochongoi" placeholder="Số chỗ ngồi..." value="{{ Request::get('sochongoi') }}">
							</div>
		
							<div class="col-md-2 col-xs-12 form-group" style="display: flex;">
								<input id="myCheck" type="checkbox" checked style="    margin-top: 12px; margin-right: 3px;">
								<input disabled  id="ngaydat" type="text" class="form-control date-picker pull-right" name="ngaydat" placeholder="Ngày Đặt..." >
							</div>
		
							<div class="col-md-2 col-xs-12 form-group">
								<input type="text" class="form-control" name="sdt" placeholder="SDT Khách Hàng..." value="{{ Request::get('sdt') }}">
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
							
							<div class="col-md-2 col-xs-12 form-group">
								<div id="taophieu" style="width: 100%" class="btn btn-info pull-left">
									<i class="fa fa-plus"></i> {{__('Tạo Phiếu')}}
								</div>
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
									<th>Ngày Đặt</th>
									<th>Giờ Đặt</th>
									<th>Tên Khách Hàng</th>
									<th>SDT</th>
								</tr>
								</thead>
								<tbody id="table">
									@foreach($data as $key => $value)
									<tr style="cursor: pointer;"
									@if( $value['trangthai'] == TRANG_THAI_BAN_TRONG ) 
										data-toggle="modal" data-target=".bd-example-modal-lg" 
										onclick="DatBan({{$value['id']}})" 
									@elseif($value['trangthai'] == TRANG_THAI_BAN_DA_DAT)
										onclick="TaoPhieu({{$value['id']}})" id="ban{{$value['id']}}"
									@endif style="color: #000000bf;" data-target="{{$value['id']}}">
										
									<td>{{ $value['id'] }}</td>
										<td>{{ $value['sochongoi'] }}</td>
										<td>@if( $value['loaiban'] == LOAI_BAN_VIP ) Bàn Vip @else Bàn Thường @endif
										<td>{{ $value['mota'] }}</td>
										<td>@if( $value['trangthai'] == 0 ) Trống @elseif($value['trangthai'] == 1) Đã Đặt @else Đang Sử Dụng @endif</td>
										<td>{{ $value['ngaydat'] }}</td>
										<td>{{ $value['giodat'] }}</td>
										<td>{{ $value['tenkhachhang'] }}</td>
										<td>{{ $value['sdt'] }}</td>
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
	<div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
		<div class="row">
			THIS IS TAB 2 CONTENT
		</div>

	</div>
	<div class="tab-pane tabs-animation fade " id="tab-content-2" role="tabpanel">
		<div class="row">
			THIS IS TAB 3 CONTENT
		</div>
	</div>
</div>
	
@endsection


@section('modal')
<form action="{{route("letan.datban")}}" method="POST" accept-charset="utf-8">
    @csrf
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Đặt Bàn</h5> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<input name="idban" id="datban_idban" type="text" class="form-control" value="0" hidden>

                <div class="row">
                    <div class="col-6">
                        <div class="position-relative form-group">
                            <label for="exampleEmail" class="">Tên Khách Hàng</label>
                            <input name="tenkhachhang" id="datban_tenkhachhang" placeholder="with a placeholder" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="position-relative form-group">
                            <label for="exampleEmail" class="">Số Điện Thoại</label>
                            <input name="sdt" id="datban_sdt" placeholder="with a placeholder" type="text" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
					<div class="col-6">
						<div class="position-relative form-group">
							<label for="exampleEmail" class="">Ngày Đặt</label>
							<input name="ngaydat" id="datban_ngaydat" placeholder="with a placeholder" type="text" class="form-control date-picker">
						</div>
					</div>
                    <div class="col-6">
						<div  class="position-relative form-group">
							<label class="">Giờ Đặt</label>
							<select name="giodat" class="form-control">
									<option value="00:00">00:00</option>
									<option value="00:30">00:30</option>
									<option value="01:00">01:00</option>
									<option value="01:30">01:30</option>
									<option value="02:00">02:00</option>
									<option value="02:30">02:30</option>
									<option value="03:00">03:00</option>
									<option value="03:30">03:30</option>
									<option value="04:00">04:00</option>
									<option value="04:30">04:30</option>
									<option value="05:00">05:00</option>
									<option value="05:30">05:30</option>
									<option value="06:00">06:00</option>
									<option value="06:30">06:30</option>
									<option value="07:00">07:00</option>
									<option value="07:30">07:30</option>
									<option value="08:00">08:00</option>
									<option value="08:30">08:30</option>
									<option value="09:00">09:00</option>
									<option value="09:30">09:30</option>
									<option value="10:00">10:00</option>
									<option value="10:30">10:30</option>
									<option value="11:00">11:00</option>
									<option value="11:30">11:30</option>
									<option value="12:00">12:00</option>
									<option value="12:30">12:30</option>
									<option value="13:00">13:00</option>
									<option value="13:30">13:30</option>
									<option value="14:00">14:00</option>
									<option value="14:30">14:30</option>
									<option value="15:00">15:00</option>
									<option value="15:30">15:30</option>
									<option value="16:00">16:00</option>
									<option value="16:30">16:30</option>
									<option value="17:00">17:00</option>
									<option value="17:30">17:30</option>
									<option value="18:00">18:00</option>
									<option value="18:30">18:30</option>
									<option value="19:00">19:00</option>
									<option value="19:30">19:30</option>
									<option value="20:00">20:00</option>
									<option value="20:30">20:30</option>
									<option value="21:00">21:00</option>
									<option value="21:30">21:30</option>
									<option value="22:00">22:00</option>
									<option value="22:30">22:30</option>
									<option value="23:00">23:00</option>
									<option value="23:30">23:30</option>
							</select>
						</div>
                    </div>
				</div>
			</div>
                
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Đặt Bàn</button>
            </div>
        </div>
    </div>
</div>
</form>

@endsection

@section('style')
<style>
select {
    height: 30px;
    width: 65px;
    border-radius: 5px;
    outline: none;
}

input[type="search"] {
    height: 30px;
    border-radius: 5px;
    outline: none;
    border: 1px solid darkgrey;
}

a.paginate_button.current {
    border-radius: 50px !important;
    background: #16aaff !important;
    border: none !important;
}

a.paginate_button:hover {
    background: #dcd1d19e !important;
    border-radius: 50% !important;
	border: none !important;
}
</style>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
			init()
		});

		function init() {
			init_daterangepicker_single_call();
			HiddenNgayDat();
		}

		function HiddenNgayDat(){
			$('#myCheck').change(function(event) {
                /* Act on the event */
                if($(this).is(':checked'))
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

		function DatBan(idban) {
			console.log(idban);
			// document.getElementById("ban"+document.getElementById("idbantruoc").value+"").style.background = "#FFFFFF";
			document.getElementById("datban_idban").value = idban;
		}

		function TaoPhieu(idban) {
			console.log(idban);
			document.getElementById("ban"+document.getElementById("idbantruoc").value+"").style.background = "#FFFFFF";
			document.getElementById("ban"+idban+"").style.background = "#E0F3FF";
			document.getElementById("idbantruoc").value = idban;
			$( "#taophieu" ).click(function() {
				$.ajax({
					url: '/letan/taophieu',
					type: 'GET',
					data: {
						idban: idban,
					},
					success: function (result) {
						if(result.success)
						{
							console.log("sdfsdf");
							$('#thongbao').append('<div id="box_msg_content"><div class="alert alert-success"><strong>Notice! </strong>'+result.msg+'</div></div>');
							// setTimeout(function(){ 
							// 	$('#box_msg_content').remove();
							// }, 10000);
						}
						else{
							// if ($('#box_msg_content')){
							// 	$('#box_msg_content').remove();
							// }
							console.log("a");
							$('#thongbao').append('<div id="box_msg_content"><div class="alert alert-danger"><strong>Notice! </strong>'+result.msg+'</div></div>');
							// setTimeout(function(){ 
							// 	$('#box_msg_content').remove();
							// }, 3000);
							
						}
					},
					error: function (e) {
						console.error(e);
					}
				});
			});
		}

		
    </script>   
@endsection