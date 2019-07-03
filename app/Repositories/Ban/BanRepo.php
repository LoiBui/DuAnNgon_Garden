<?php  
namespace App\Repositories\Ban;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Ban\BanRepoInterface;
use App\Validators\BanValidator;
use App\Model\Ban;
use DB;

class BanRepo extends BaseRepository implements BanRepoInterface{
	public function model()
    {
        return Ban::class;
    }

	/**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return BanValidator::class;
    }
}




?>