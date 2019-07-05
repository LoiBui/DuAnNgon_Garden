<?php
namespace  App\Repositories;
use Illuminate\Database\Eloquent\Model;
/**
 * summary
 */
class BaseRepository implements BaseRepositoryInterface
{
    /**
     * summary
     */
    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function find($id)
    {
    	return $this->model->find($id);
    }

    public function all()
    {
    	return $this->model->get();
    }

    public function paginate($limit){
        return $this->model->paginate($limit);
    }

    public function destroy($id){
        return $this->model->find($id)->delete();
    }
}
