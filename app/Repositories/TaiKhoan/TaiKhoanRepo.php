<?php  
namespace App\Repositories\TaiKhoan;

use App\Repositories\BaseRepository;
use App\Model\TaiKhoan;
use DB;



class TaiKhoanRepo extends BaseRepository implements TaiKhoanRepoInterFace{
	public function __construct(TaiKhoan $tk)
	{
		parent::__construct($tk);
	}

	public function update(Array $data){
		$tk = TaiKhoan::find($data["id"]);
		
		$tk->tennguoidung = $data["tennguoidung"];
		$tk->gioitinh = $data["gioitinh"];
		$tk->socmnd = $data["socmnd"];
		$tk->email = $data["email"];
		$tk->sdt = $data["sdt"];
		$tk->quequan = $data["quequan"];
		if (isset($data["matkhau"])){
			$tk->matkhau = $data["matkhau"];
		}
		return $tk->save();
	}

	public function store(Array $data){
		return DB::table('TaiKhoans')->insert([
			"tendangnhap" => $data["tendangnhap"],
			"tennguoidung" => $data["tennguoidung"],
			"matkhau" => $data["matkhau"],
			"gioitinh" => $data["gioitinh"],
			"socmnd" => $data["socmnd"],
			"email" => $data["email"],
			"sdt" => $data["sdt"],
			"quequan" => $data["quequan"],
			"quyen" => $data["quyen"]
		]);
		
	}
}




?>