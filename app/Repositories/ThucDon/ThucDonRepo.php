<?php  
namespace App\Repositories\ThucDon;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ThucDon\ThucDonRepoInterface;
// use App\Validators\LeTanValidator;
use App\Model\ThucDon;
use DB;

class ThucDonRepo extends BaseRepository implements ThucDonRepoInterface{
	public function model()
    {
        return ThucDon::class;
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