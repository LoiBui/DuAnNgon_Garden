@extends('Layout.index')

@section('content')
<div class="main-card mb-3 card">
        <div class="card-body"><h5 class="card-title">Danh Sách Sự Cố</h5>
            <table class="mb-0 table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>id Hóa Đơn</th>
                    <th>Nội Dung</th>
                    <th>Hành Động</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($xulysuco as $key=> $value)
                    <tr>
                        <th scope="row">{{$key + 1}}</th>
                        <td>{{$value->idhoadon}}</td>
                        <td>{{$value->mieuta}}</td>
                    <td><a href="phanhoi/xoa/{{$value->id}}" class="mb-2 mr-2 btn btn-warning">Xử Lý Xong</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
