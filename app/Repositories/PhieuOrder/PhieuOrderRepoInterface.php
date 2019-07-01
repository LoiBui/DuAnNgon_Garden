<?php  
namespace App\Repositories\PhieuOrder;

use App\Repositories\BaseRepositoryInterface;

interface PhieuOrderRepoInterface extends BaseRepositoryInterface{
	public function update(Array $data);
	public function store(Array $data);
}



?>