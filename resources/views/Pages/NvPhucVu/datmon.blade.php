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
								<th>Ghi Chú</th>
								<th>Thêm</th>
							</tr>
							</thead>
							<tbody id="table">
								@foreach($monans as $key => $value)
								<tr>
									<td>{{ $value->id }}</td>
									<td>{{ $value->ten }}</td>
									<td>@if( $value['loai'] == LOAI_MON_DO_AN ) Đồ Ăn @else Nước Uống @endif</td>
									<td>{{ $value->giatien }}</td>
									<form action="{{route('nvphucvu.themmon', [$idphieuorder , $value->id])}}" method="POST">
										@csrf
										<td><input type="text" name="soluong" id="soluong" style="width: 50px"></td>
										<td><input type="text" name="ghichu" id="ghichu" style="width: 50px"></td>
										<td class="text-center"><button class="btn btn-primary" type="submit"><i class="fa fa-plus fa-lg"></i></button></td>
									</form>
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
					<div class="table-responsive">
						<table class="mb-0 table">
							<thead>
							<tr>
								<th>Tên Món</th>
								<th>Loại</th>
								<th>Giá Tiền</th>
								<th>Số Lượng</th>
								<th>Trạng thái</th>
								<th class="text-center">Sửa</th>
								<th class="text-center">Xóa</th>
							</tr>
							</thead>
							<tbody id="table">
								@foreach($monanorders as $key => $value)
								<tr>
									<td>{{ $value['tenmon'] }}</td>
									<td>@if( $value['loai'] == LOAI_MON_DO_AN ) Đồ Ăn @else Nước Uống @endif</td>
									<td>{{ $value['giatien'] }}</td>
									<form action="{{route('nvphucvu.suamon', [$value['idphieuorder'], $value['id']])}}" method="POST">
										@csrf
										<td><input type="text" name="soluong" style="width: 50px;" value="{{ $value['soluong'] }}"></td>
										<td>@if( $value['trangthai'] == TRANG_THAI_MON_CHUA_LAM ) Chưa Làm @elseif($value['trangthai'] == TRANG_THAI_MON_DANG_LAM) Đang Làm @else Hoàn Thành @endif</td>
										
										<td class="text-center">
											<button type="submit" class="btn btn-success">
												<i class="fa fa-edit fa-lg"></i>
											</button>
										</td>
										
										<td class="text-center">
											<a @if($value['trangthai'] != TRANG_THAI_MON_CHUA_LAM ) class="btn btn-danger disabled" @else class="btn btn-danger" @endif 
												href="{{ url(route('nvphucvu.xoamon', [$value['idphieuorder'], $value['id']])) }}">
												<i class="fa fa-trash-alt fa-lg"></i>
											</a>
										</td>
									</form>	
								</tr>
								@endforeach
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



