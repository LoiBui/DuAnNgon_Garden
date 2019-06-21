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
		return $tk->save();
	}
}




?>