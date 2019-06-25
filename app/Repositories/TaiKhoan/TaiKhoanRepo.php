<?php  
namespace App\Repositories\TaiKhoan;

use App\Repositories\BaseRepository;
use App\Model\TaiKhoan;



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
}




?>