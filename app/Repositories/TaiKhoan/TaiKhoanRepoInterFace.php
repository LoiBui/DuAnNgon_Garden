<?php  
namespace App\Repositories\TaiKhoan;

use App\Repositories\BaseRepositoryInterface;

interface TaiKhoanRepoInterFace extends BaseRepositoryInterface{
	public function update(Array $data);
	public function store(Array $data);
}



?>