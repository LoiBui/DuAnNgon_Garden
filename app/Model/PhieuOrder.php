<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PhieuOrder extends Model
{
    protected $table = "phieuorders";
    
    public function Ban(){
        return $this->hasOne("App\Model\Ban", "id", "idBan");
    }

    public function NhanVien(){
        return $this->hasOne("App\Model\TaiKhoan", "id", "idnhanvien");
    }
}
