<?php  
namespace App\Repositories\NVPhucVu;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\NVPhucVu\NvPhucVuRepoInterface;
// use App\Validators\LeTanValidator;
use App\Model\ThucDon;
use DB;

class NvPhucVuRepo extends BaseRepository implements NvPhucVuRepoInterface{
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