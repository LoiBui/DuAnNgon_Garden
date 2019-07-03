<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Model\Ban;
use App\Model\DatBan;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function datban(Request $re){
        $query = 'SELECT * FROM bans JOIN datbans on bans.id = datbans.idban  WHERE datbans.ngaydat = "'.$re->ngaydat.'" AND MINUTE(TIMEDIFF(datbans.giodat,"'.$re->giodat.'")) /60 + HOUR(TIMEDIFF(datbans.giodat,"'.$re->giodat.'")) > 2 AND (bans.sochongoi + 3 > '.$re->songuoi.' || bans.sochongoi = 11) AND datbans.trangthai = 2';
        $data = DB::select($query);
        
        $idBan = "";
        
        if (count($data) > 0){
            foreach($data as $value){
                if ($value->sochongoi == $re->songuoi){
                    $idBan = $value->idban;
                    break;
                }
            }
            if ($idBan == ""){
                $idBan = $data[0]->id;
            }
        }else{
            $que = 'SELECT * FROM bans WHERE (sochongoi > 11 OR sochongoi + 3>11) AND MINUTE(TIMEDIFF(NOW(), "'.$re->ngaydat.' '.$re->giodat.'"))/60 + HOUR(TIMEDIFF(NOW(), "'.$re->ngaydat.' '.$re->giodat.'")) > 2 AND trangthai = 0';
            
            $data1 = DB::select($que);
            if ($data1){
                foreach($data1 as $value){
                    if ($value->sochongoi == $re->songuoi){
                        $idBan = $value->id;
                        break;
                    }
                }
                if ($idBan == ""){
                    $idBan = $data[0]->id;
                }
            }
            
        }
        if ($idBan == ""){
        return redirect("thanhcong")->with("notice", "Đặt Bàn Thất Bại<br> Không còn bàn");
        }
        $db = new Datban;
        $db->idban = $idBan;
        $db->ngaydat = $re->ngaydat;
        $db->giodat = $re->giodat;
        $db->tenkhachhang = $re->hoten;
        $db->sdt = $re->sdt;
        $db->trangthai = 0;
        $db->save();
        return redirect("thanhcong")->with("notice", "Đặt Bàn Thành Công<br> Chúng tôi sẽ gọi điện xác nhận lại trong giây lát");
    }
}
