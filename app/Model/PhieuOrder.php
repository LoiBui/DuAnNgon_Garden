<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PhieuOrder extends Model
{
    protected $table = "phieuorders";

    protected $fillable = [
        'id','idban','thoigiantao', 'trangthai'
    ];

    public function Ban(){
        return $this->hasOne("App\Model\Ban", "id", "idban");
    }

    public function NhanVien(){
        return $this->hasOne("App\Model\TaiKhoan", "id", "idnhanvien");
    }

    public function ThucDons(){
        return $this->belongsToMany(ThucDon::class, 'chitietphieus', 'idphieuorder', 'idmon')->withPivot('trangthai');
    }
}
