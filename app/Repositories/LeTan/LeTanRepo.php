<?php  
namespace App\Repositories\LeTan;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LeTan\LeTanRepoInterface;
use App\Validators\LeTanValidator;
use App\Model\Ban;
use DB;

class LeTanRepo extends BaseRepository implements LeTanRepoInterface{
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
        // return CalendarValidator::class;
    }
}




?>