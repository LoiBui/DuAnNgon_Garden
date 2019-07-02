<?php  
namespace App\Repositories\ChiTietPhieu;

use App\Repositories\BaseRepository;
use App\Model\ChiTietPhieu;
use DB;



class ChiTietPhieuRepo extends BaseRepository implements ChiTietPhieuRepoInterface{
	public function __construct(ChiTietPhieu $tk)
	{
		parent::__construct($tk);
	}

	public function update(Array $data){
		
	}

	public function store(Array $data){
		
	}

	public function findByIdPhieuOrder($id){
		return ChiTietPhieu::where("idphieuorder", $id)->get();
	}
}




?>