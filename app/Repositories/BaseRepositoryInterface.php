<?php  
namespace App\Repositories;



interface BaseRepositoryInterface{
	
	public function all();
	public function find($id);
	public function destroy($id);
}


?>