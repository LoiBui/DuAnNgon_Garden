@extends('Layout.index')

@section('content')
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<form class="form-horizontal form-label-left input_mask">
				<div class="row">
					<div class="col-md-2 col-xs-12 form-group">
						<input type="text" class="form-control" name="id" placeholder="Mã Món..." value="{{ Request::get('id') }}">
					</div>

					<div class="col-md-2 col-xs-12 form-group">
						<input type="text" class="form-control" name="ten" placeholder="Tên Món..." value="{{ Request::get('ten') }}">
					</div>

					<div class="col-md-2 col-xs-12 form-group">
						<select name="loai" class="form-control">
							<option>{{__('-- Loại --')}}</option>
							<option>{{__('Đồ Ăn')}}</option>
							<option>{{__('Nước Uống')}}</option>
						</select>
					</div>

					<div class="col-md-2 col-xs-12 form-group">
						<form  method="POST" class="form-horizontal form-label-left">
							<button href="{{ url(route('nvphucvu')) }}" style="width: 100%" type="submit" class="btn btn-success btn-search"><i class="fa fa-search"></i> {{__('search')}}</button>
						</form>
					</div>
				</div>
			</form>
		</div>
		<input type="text" id="idbantruoc" value="1" hidden>
	</div>

    <div class="row">
		<div class="col-lg-6">
			<div class="main-card mb-3 card">
				<div class="card-body"><h5 class="card-title">Món Ăn  </h5>
					<div class="table-responsive">
						<table class="mb-0 table">
							<thead>
							<tr>
								<th>Mã Món</th>
								<th>Tên Món</th>
								<th>Loại</th>
								<th>Giá Tiền</th>
								<th>Số Lượng</th>
								<th>Thêm</th>
							</tr>
							</thead>
							<tbody id="table">
								@foreach($monans as $key => $value)
								<tr>
									<td>{{ $value['id'] }}</td>
									<td>{{ $value['ten'] }}</td>
									<td>@if( $value['loai'] == LOAI_MON_DO_AN ) Đồ Ăn @else Nước Uống @endif
										<td>{{ $value['giatien'] }}</td>
									<td><input style="width: 50px;" type="text"></td>
									<td class="text-center" style="cursor: pointer;"><a style="height:35x;"><i class="fa fa-plus"></i></a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<hr>
						<div style="float: right;">
							{{$monans->links()}}
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="main-card mb-3 card">
				<div class="card-body"><h5 class="card-title">Đặt Món  </h5>
					<div class="table-responsive table-hover">
						<table class="mb-0 table">
							<thead>
							<tr>
								<th>Mã Món</th>
								<th>Tên Món</th>
								<th>Loại</th>
								<th>Giá Tiền</th>
								<th>Số Lượng</th>
								<th>Sửa</th>
								<th>Xóa</th>
							</tr>
							</thead>
							<tbody id="table">
								<tr style="cursor: pointer;">
									<th></th>
								</tr>
							</tbody>
						</table>
						<hr>
						<div style="float: right;">
						</div>
					</div>
				</div>
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

