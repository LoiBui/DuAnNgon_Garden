@extends('Layout.index')

@section('content')
    <div class="row">
            <div class="col-lg-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">Table responsive</h5>
                            <div class="table-responsive">
                                <table class="mb-0 table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên Đăng Nhập</th>
                                        <th>Tên Người Dùng</th>
                                        <th>Giới Tính</th>
                                        <th>Số CMND</th>
                                        <th>Email</th>
                                        <th>SĐT</th>
                                        <th>Quê Quán</th>
                                        <th>Hành Động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                            @foreach($data as $key => $value)
                                            <tr style="color: #000000bf;">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $value->tendangnhap }}</td>
                                                <td>
                                                        {{ $value->tennguoidung }}
                                                </td>
                                                <td>
                                                        @if($value->gioitinh) {{ "Nam" }} @elseif(!$value->gioitinh) {{ "Nữ" }} @else {{ "Khác" }} @endif
                                                </td>
                                                <td>{{ $value->socmnd }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->sdt }}</td>
                                                <td>
                                                        {{ $value->quequan }}
                                                </td>
                                                <td style="display: flex;">
                                                <a href="taikhoan/destroy/{{$value->id}}" class="mb-2 mr-2 btn btn-danger"><i class="pe-7s-trash" style="font-size: 20px;"> </i></a>
                                                    <a data-toggle="modal" data-target=".bd-example-modal-lg" href="" class="mb-2 mr-2 btn btn-info"><i class="pe-7s-pen" style="font-size: 20px;"> </i></a>
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
    

@endsection

@section('modal')
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection