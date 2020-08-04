<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ChiTietPhieu extends Model
{
    protected $table = "chitietsphieus";

    public function ThucDon(){
        return $this->hasOne("App\Model\ThucDon", "id", "idmon");
    }
}
