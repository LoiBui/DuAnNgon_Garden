@extends('Layout.index')

@section('content')
<div id="obj">
	<div class="row">
		<div class="col-6">
			<div class="main-card mb-3 card">
				<div class="card-body"><h5 class="card-title">Danh Sách Bàn Ăn</h5>
					<table class="mb-0 table">
						<thead>
						<tr>
							<th>Mã Bàn</th>
							<th>Thời Gian Tạo</th>
							<th>Trạng Thái</th>
						</tr>
						</thead>
						<tbody>
						<tr v-for = "(item, index) in phieuorder" v-if = "item.trangthai != 2" @click = "chooseOrder(item.id, item.trangthai)" :class = "{choose: item.id == currentOrder}">
							<td>@{{item.idban}}</td>
							<td>@{{convertDate(item.thoigiantao)}}</td>
							<td>
								<div class="status statusDanger" v-if = "item.trangthai == 0" @click = "start(item.id)">Chưa Làm</div>	
								<div class="status statusPending" v-if = "item.trangthai == 1" @click = "start(item.id)">Đang Làm</div>	
								<div class="status statusPending" v-if = "item.trangthai == 2" @click = "start(item.id)">Hoàn Thành</div>	
							</td>
						</tr>
						</tbody>
					</table>
					<img v-if = "isLoading" class="loading" src="icon/loading.gif" alt="">
				</div>
			</div>
		</div>

		<div class="col-6">
			<div class="main-card mb-3 card">
				<div class="card-body">
					<h5 class="card-title">Chi Tiết Món Ăn Theo Bàn</h5>
					<button v-if = "chitietphieuorder.length > 0 && trangthai == 0" class="mt-2 btn btn-primary"  style="margin-bottom: 7px;" @click = "nhanlam(currentOrder, trangthai)">Nhận Làm</button>
					<button v-if = "chitietphieuorder.length > 0 && trangthai == 1" class="mt-2 btn btn-warning"  style="margin-bottom: 7px;" @click = "nhanlam(currentOrder, trangthai)">Đang Làm</button>
					<button v-if = "chitietphieuorder.length > 0 && trangthai == 2" class="mt-2 btn btn-success"  style="margin-bottom: 7px;">Hoàn Thành</button>
					<table class="mb-0 table">
						<thead>
						<tr>
							<th>Tên Món Ăn</th>
							<th>Số Lượng</th>
							<th>Ghi Chú</th>
							<th v-if = "trangthai == 1">Hành Động</th>
						</tr>
						</thead>
						<tbody>
							
						<tr v-for = "(item, index) in chitietphieuorder">
							<td>@{{item.tenmon}}</td>
							<td>@{{item.soluong}}</td>
							<td>@{{item.ghichu}}</td>
							<td>
								<div class="status statusDanger" v-if = "item.trangthai == 0 && (trangthai == 1 || trangthai ==3)" @click = "start(item.id)">Đang Chờ</div>	
								<div class="status statusPending" v-if = "item.trangthai == 1  && (trangthai == 1 || trangthai ==3)" @click = "start(item.id)">Đang Làm</div>	
								<div class="status statusSucess" v-if = "item.trangthai == 2  && (trangthai == 1 || trangthai ==3)">Hoàn Thành</div>	
							</td>
						</tr>
						
						</tbody>
						
					</table>
					<p v-if = "chitietphieuorder.length == 0 && !isloading">Không Tìm Thấy Dữ Liệu</p>
					<img v-if = "isloading" class="loading" src="icon/loading.gif" alt="">
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
	new Vue({
	el: "#obj",
	data:{
		phieuorder: [],
		chitietphieuorder: [],
		currentOrder: '',
		trangthai: '',
		isloading: false,
		isLoading: true,
	},
	created() {
		var cur = this;
		$.ajax({
                type: "GET",
                url: 'getPhieuOrder',
                data: "check",
                success: function(data){
					cur.phieuorder = data;
					cur.isLoading = false;
                },
				error: (er)=>{
					console.log(er);
				}
            });
	},
	methods:{
		chooseOrder(id, trangthai){
			this.chitietphieuorder = [];
			this.isloading = true;
			this.currentOrder = id;
			this.trangthai = trangthai;
			var cur = this;
			$.ajax({
                type: "GET",
                url: 'getChiTietPhieubyIdPhieuOrder/'+id,
                success: function(data){
					cur.chitietphieuorder = data;
					cur.isloading = false;
                }
            });
		},
		start(id){
			var status = "";
			this.chitietphieuorder.forEach(element => {
				if (element.id == id){
					console.log(element)
					if (element.trangthai == 1){
						element.trangthai = 2;
						status = 2;
					}else if(element.trangthai == 0){
						element.trangthai = 1;
						status = 1;
					}
					return;
				}
			});
			
			if(status==''){
				return;
			}
			$.ajax({
                type: "POST",
                url: 'thaydoitrangthaichitietphieu',
                data: {
					"id":id,
					"status":status
				},
                success: function(data){
					console.log(data);
                }
            });
			
			let ktc = true;
			this.chitietphieuorder.forEach(element => {
				if(element.trangthai != 2){
					ktc = false;
				}
			});
			if(ktc){
				console.log(this.currentOrder)
				this.trangthai = 2;
				this.phieuorder.forEach((element, index) => {
					if(element.id == this.currentOrder){
						Vue.set(this.phieuorder[index], 'trangthai', 2);
						console.log("ok")
					}
				});
				console.log(this.phieuorder);
			}
			
		},
		nhanlam(id, trangthai){
			var status = "";
			if (trangthai == 0){
				status = 1;
			}else if (trangthai == 1){
				let check = true;
				this.chitietphieuorder.forEach(el=>{
					if (el.trangthai == 0 || el.trangthai == 1){
						check = false;
						return;
					}
				});
				if (check)
					status = 2;
				else{
					alert("Bạn không thể nhấn hoàn thành trong khi các món ăn chưa làm xong");
					return;
				}
			}
			if(trangthai == 3){
				status = 2;
			}

			this.phieuorder.forEach(el=>{
				if (el.id == id){
					el.trangthai = status;
				}
			});
			this.trangthai = status;
			$.ajax({
                type: "POST",
                url: 'thaydoitrangthaiphieuorder',
                data: {
					"id":id,
					"status":status
				},
                success: function(data){
					console.log(data);
                }
            });
		},
		convertDate(value){
			return value.split(" ")[1]; 
		}
	}

})
</script>
@endsection
@section('style')
<style>
.statusDanger{
	background: #ff010185;   
	cursor: pointer;
}

.statusPending{
	background: orange;
	cursor: pointer;
}

.statusSucess{
	background: #02ce65;
	width: 85px !important;
}
.status{
	color: white;
    padding: 3px;
    border-radius: 9px;
	width: 70px;
}

.choose{
	background: #00000014;
}

.loading{
	width: 55px;
    display: block;
    margin: auto;
}
</style>
@endsection