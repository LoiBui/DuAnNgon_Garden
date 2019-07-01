<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DatBan extends Model
{
    protected $table = "datbans";

    public function bans(){
        return $this->hasMany(Ban::class, 'idban', 'id');
    }
}
