<?php  
namespace App\Repositories\ChiTietPhieu;

use App\Repositories\BaseRepositoryInterface;

interface ChiTietPhieuRepoInterface extends BaseRepositoryInterface{
	public function update(Array $data);
	public function store(Array $data);
	public function findByIdPhieuOrder($id);
}



?>