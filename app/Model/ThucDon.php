<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ThucDon extends Model
{
    //
    protected $table = "thucdons";

    public function chitietphieus()
    {
        return $this->hasMany('ChiTietPhieu','idmon','id');
    }
}
