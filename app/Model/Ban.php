<?php

namespace App\Model;
use Prettus\Repository\Contracts\Transformable;

use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    protected $table = "bans";

    public function datban(){
        return $this->hasOne(DatBan::class, 'idban', 'id');
    }
}
