@extends('Layout.index')

@section('content')
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<form class="form-horizontal form-label-left input_mask">
				<div class="row">
					<div class="col-md-2 col-xs-12 form-group">
						<input type="text" class="form-control" name="sochongoi" placeholder="Số chỗ ngồi..." value="{{ Request::get('sochongoi') }}">
					</div>

					<div class="col-md-2 col-xs-12 form-group">
						<input type="text" class="form-control" name="ngaydat" placeholder="Ngày Đặt..." value="{{ Request::get('ngaydat') }}">
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
						<button style="width: 100%" class="btn btn-success btn-search pull-left">
							<i class="fa fa-plus"></i> {{__('Tạo Phiếu')}}
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>

    <div class="row">
		<div class="col-lg-12">
			<div class="main-card mb-3 card">
				<div class="card-body"><h5 class="card-title">Bàn  </h5>
					

					<div class="table-responsive">
						<table class="mb-0 table">
							<thead>
							<tr>
								<th>#</th>
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
							<tbody>
								@foreach($data as $key => $value)
								<tr style="color: #000000bf;" data-target="{{$value['id']}}">
									<td>{{ $key + 1 }}</td>
									<td>{{ $value['sochongoi'] }}</td>
									<td>@if( $value['loaiban'] == 0 ) Bàn Thường @else Bàn Vip @endif
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
							{{$bans->links()}}
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
@endsection