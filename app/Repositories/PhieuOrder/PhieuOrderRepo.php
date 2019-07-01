<?php  
namespace App\Repositories\PhieuOrder;

use App\Repositories\BaseRepository;
use App\Model\PhieuOrder;
use DB;



class PhieuOrderRepo extends BaseRepository implements PhieuOrderRepoInterface{
	public function __construct(PhieuOrder $tk)
	{
		parent::__construct($tk);
	}

	public function update(Array $data){
		
	}

	public function store(Array $data){
		
		
	}
}




?>