<?php
namespace App\Repositories\ThucDon;

use App\Repositories\BaseRepository;
use App\Model\ThucDon;


class ThucDonRepo extends BaseRepository implements ThucDonRepoInterFace
{
    public function __construct(ThucDon $thucdon)
    {
        parent::__construct($thucdon);
    }


}


?>