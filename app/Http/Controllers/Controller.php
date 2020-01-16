<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Model\Ban;
use App\Model\DatBan;
use App\Model\XuLySuCo;
use App\Model\HoaDon;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function datban(Request $re){
        // dd($re->all());
        $data = DB::select(DB::raw("exec dbo.pc_timkiembanphuhop ".$re->songuoi.",'".$re->ngaydat."','".$re->giodat."','".$re->hoten."',".$re->sdt));
        
        if($data[0]->result == 0){
            $re->session()->flash('notice','Đặt Bàn Thất Bại<br> Không còn bàn');
        }else{
            $re->session()->flash('notice','Đặt Bàn Thành Công<br> Chúng tôi sẽ gọi điện xác nhận lại trong giây lát');
        }
        return redirect()->route('thanhcong');
    }

    public function phanhoi()
    {
        return view("Pages/XuLySuCo/index"); 
    }
    public function checkhd(Request $request)
    {
        $hoadon = HoaDon::where('id','=',$request->ma_hd)->first();
        if($hoadon)
        {
            return 1;
        }
        return 0;
    }

    public function savephanhoi(Request $re){
        $hd = new XuLySuCo;
        $hd->idhoadon = $re->mahd;
        $hd->mieuta = $re->noidung;
        $hd->save();
        $re->session()->flash('thongbao', __('Thêm Thành Công'));
                return redirect("phanhoi");
    }

    public function danhsach(){
        $xulysuco = XuLySuCo::get();
        return view("Pages.XuLySuCo.danhsach", compact("xulysuco"));
    }

    public function xoa($id){
        $xulysuco = XuLySuCo::find($id);
        $xulysuco->delete();
        return redirect("phanhoi/danhsach")->with('thongbao', __('Xóa Thành Công'));
    }
}
