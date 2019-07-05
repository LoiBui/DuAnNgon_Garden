@extends('Layout.index')

@section('content')
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<form class="form-horizontal form-label-left input_mask">
				<div class="row">
					<div class="col-md-2 col-xs-12 form-group">
						<input type="text" class="form-control" name="idban" placeholder="ID Bàn..." value="{{ Request::get('sochongoi') }}">
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
		<div class="col-lg-12">
			<div class="main-card mb-3 card">
				<div class="card-body"><h5 class="card-title">Phiếu Order</h5>
					<div class="datatable table-responsive">
						<table class="mb-0 table">
							<thead>
							<tr>
								<th>ID Phiếu</th>
								<th>Bàn</th>
								<th>Tên Nhân Viên</th>
								<th>Thời Gian Tạo</th>
								<th class="text-center">Chi Tiết</th>
								<th class="text-center">Đặt Món</th>
							</tr>
							</thead>
							<tbody>
								@foreach($data as $key => $value)
								<tr>
									<td>{{ $value['id'] }}</td>
									<td>{{ $value['idban'] }}</td>
									<td>{{ $value['tennhanvien'] }}</td>
									<td>{{ $value['thoigiantao'] }}</td>
									<td class="text-center">
										<button class="btn btn-success" style="cursor: pointer" onclick="ChieTietPhieu({{$value['id']}})" data-toggle="modal" data-target=".bd-example-modal-lg">
											<i class="fa fa-info-circle fa-lg"></i>
										</button>
									</td>
									
									<td class="text-center"><a class="btn btn-primary" href="{{ url(route('nvphucvu.datmon', $value['id'])) }}"><i class="fa fa-calendar-plus fa-lg"></i></a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<hr>
						<div style="float: right;">
							{{$phieuorders->links()}}
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
                <h5 class="modal-title" id="exampleModalLongTitle">Chi Tiết Phiếu</h5> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<div class="col-lg-12">
					<div class="main-card mb-3 card">
						<div class="card-body"><h5 class="card-title">Các Món Đã Đặt </h5>
							<div class="table-responsive table-hover">
								<table class="mb-0 table">
									<thead>
									<tr>
										<th>Mã Món</th>
										<th>Tên Món</th>
										<th>Loại</th>
										<th>Giá Tiền</th>
										<th>Số Lượng</th>
										<th>Trạng Thái</th>
									</tr>
									</thead>
									<tbody id="table">
										
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
                
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</form>

@endsection

@section('script')
    <script>
		function ChieTietPhieu(idphieu) {
			console.log(idphieu);
			$.ajax({
				url: 'nvphucvu/ajax/getchitietphieu',
				type: 'GET',
				data: {
					idphieuorder: idphieu,
				},
				success: function (result) {
					console.log(result);
					if(result.success)
					{
						for (let index = 0; index < result.data.length; index++) {
							var loai = '', trangthai = '';
							if(result.data[index].loai == 0)
								loai = 'Đồ Ăn';
							else
								loai = 'Nước Uống';

							if(result.data[index].trangthai == 0)
								trangthai = 'Chưa Làm';
							else if(result.data[index].trangthai == 1)
								trangthai = 'Đang Làm';
							else
								trangthai = 'Hoàn Thành';

							$('#table').append(
								'<tr>'
									+'<td>'+result.data[index].id+'</td>'
									+'<td>'+result.data[index].tenmon+'</td>'
									+'<td>'+loai+'</td>'
									+'<td>'+result.data[index].giatien+'</td>'
									+'<td>'+result.data[index].soluong+'</td>'
									+'<td>'+trangthai+'</td>'
								+'</tr>'
							);
						}
					}
				},
				error: function (e) {
					console.error(e);
				}
			});
		}
    </script>   
@endsection

