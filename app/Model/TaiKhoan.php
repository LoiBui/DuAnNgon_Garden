<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TaiKhoan extends Authenticatable
{
    protected $table = "taikhoans";

    protected $fillable = [
        'id','username', 'password', 'tennguoidung', 'gioitinh', 'socmnd', 'quequan', 'sdt', 'email', 'quyen', 
    ];
}
