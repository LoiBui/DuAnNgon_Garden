<?php

namespace App\Http\Controllers\MyControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Ban\BanRepoInterface;
use Illuminate\Support\Facades\DB;
use App\Validators\BanValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Validators\BaseValidatorInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;
use App\Model\DatBan;
use App\Model\PhieuOrder;
use App\Model\ChiTietPhieu;
use Carbon\Carbon;
use App\Model\Ban;
use App\Model\HoaDon;


class LeTanController extends Controller
{
    protected $BanRepo;
    protected $BanValiDate;

    public function __construct(BanRepoInterface $var, BanValidator $validate){
        $this->BanRepo = $var;
        $this->BanValiDate = $validate;
    }

    public function index(Request $request)
    {
        $page = "";
        //data phần list bàn
        $search = [];
        $invalid = [];
        if ($request->sochongoi != '') {
            $search[] = ['sochongoi', $request->sochongoi];
        }

        

        if ($request->has('trangthai') && $request->query('trangthai') != "-- Trạng Thái --") {
            switch ($request->query('trangthai')) {
                case __('Trống'):
                    $search[] = ['trangthai', TRANG_THAI_BAN_TRONG];
                    break;
                case __('Đã Đặt'):
                    $search[] = ['trangthai', TRANG_THAI_BAN_DA_DAT];
                    break;
                case __('Đang Sử Dụng'):
                    $search[] = ['trangthai', TRANG_THAI_BAN_DANG_SU_DUNG];
                    break;    
                default:
                    break;
            }
        }else{
            
            $search[] = ['trangthai', '<>' , TRANG_THAI_BAN_DANG_SU_DUNG];
            $datban = DatBan::where("trangthai", 1)->get();
            $now = Carbon::now();
            foreach($datban as $value){
                
                $currentTime = Carbon::parse($value->ngaydat . " " . $value->giodat);
                $diff = $now->diffInMinutes($currentTime)/60;
                //echo $diff . "<br>";
                if ($diff < 2){
                    array_push($invalid, $value->idban);
                }
            }
        }
        
        
        
        $bans = $this->BanRepo->scopeQuery(function ($query) use ($search) {
            return $query
                ->where($search);
        });

        

        $bans = $bans->findWhereNotIn("id",$invalid);
        
        foreach($bans as $value){
            $value->infoOrder = $value->DatBan;
        }
        
        
        
        $data = $bans->toArray();

        

        if(empty($data))
            $data = [];
        

            $page = Input::get('page', 1); 

            $perPage = 10;

            $offSet = ($page * $perPage) - $perPage; // Start displaying items from this number

            $itemsForCurrentPage = array_slice($data, $offSet, $perPage, true);

            $data = new LengthAwarePaginator($itemsForCurrentPage, count($data), $perPage, $page, 
        ['path' => request()->url(), 'query' => request()->query()]);
        $page = 1;

        //data phần đặt bàn
        $kiemtra = 1;
        $datban = [];
        $search_datban = [];
        if ($request->sdt != '') {
           
            $datban = DatBan::where("sdt", $request->query('sdt'));
            $kiemtra = 0;
        }
        if ($request->ngaydat != '') {
            if ($kiemtra == 0){
                $datban = $datban->where("ngaydat", $request->query('ngaydat'));
            }else{
                $datban = DatBan::where("ngaydat", $request->query('ngaydat'));
            }
            $kiemtra = 0;
        }
        if ($request->has('sdt') || $request->has('ngaydat')){
            $page = 2;
        }
        

        if ($kiemtra == 0){
            $datban = $datban->paginate(10);
            $page = 2;
        }else{
            $datban = DatBan::where("trangthai", "<>", "2")->paginate(10);
        }


        //thanh toán
        $databan = Ban::where("trangthai", 1);
        if ($request->idban != "")
        {
            $page = 3;
            $databan = $databan->where("id", $request->idban);
        }else if ($request->has("idban")){
            $page = 3;
        }
        $databan = $databan->paginate(10);
        return view("Pages.LeTan.index", compact('data', 'datban', 'databan', "page"));
    }

    public function chuyentranthaiban(Request $re){
        $ban = Ban::find($re->idban);
        $ban->trangthai = TRANG_THAI_BAN_DANG_SU_DUNG;
        if ($ban->save()){
            return 1;
        }
        return 0;
    }

    public function chuyentranthaibanonline(Request $re){
        $db = DatBan::find($re->iddatban);
        $db->trangthai = 2;
        $db->save();

        $ban = Ban::find($db->idban);
        $ban->trangthai = 1;
        $ban->save();
        return 1;
    }
    public function taophieu(Request $request)
    {
        if ($request->has('idban')) {
            $idban = $request->query('idban');
        }
        
        if(DB::table('phieuorders')->insert([
            'idban', $idban,
            'idnhanvien', \Auth::user()->id,
            'thoigiantao', date('Y-m-d H:i:s')
        ]))
        if(1==1)
        {
            return response()->json(['success' => true, 'msg' => 'Tạo Phiếu Thành Công']);
        }
        else{
            return response()->json(['success' => false, 'msg' => 'Tạo Phiếu Thất Bại!']);
        }
    
        return response()->json(['success' => true, 'msg' => 'Tạo Phiếu Thành Công']);
    }

    public function datban(Request $request)
    {
        try {
            $data = $request->all();
            unset($data['_token']);

            $this->BanValiDate->with($data)->passesOrFail(BaseValidatorInterface::RULE_CREATE);

            
            $data = array_merge($data, [
                'trangthai' => 0,
            ]);

            // $datban = $this->BanRepo->create($data);
            if(DB::table('datbans')->insert($data) && DB::table('bans')->where('id', $data['idban'])->update(['trangthai' => 1]))
            {
                $request->session()->flash('thongbao', 'Đặt Bàn Thành Công');
            }
                
            return redirect()->back();
        } catch (ValidatorException $e) {
            $request->session()->flash('thongbao','Đặt Bàn Thất Bại');
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function getidphieuorderByidBan($type, $idban){
        
        try{
            $phieuorder = PhieuOrder::where("idban", $idban)->where("trangthai", 2)->first();
            
            if (!$phieuorder){
                return [
                    "err"=>"1",
                    "data"=>"Không Tìm Thấy Dữ Liệu"
                ];
            }
            else{
                
                $chitietphieu = ChiTietPhieu::where("idphieuorder", $phieuorder->id)->get();
                
                foreach($chitietphieu as $value){
                    $value->thucdon = $value->ThucDon;
                }
                if ($type == 1){
                    return [
                        "err"=>"0",
                        "data"=>$chitietphieu
                    ];
                }else{
                    $phieu = PhieuOrder::find($phieuorder->id);
                    $phieu->trangthai = 4;
                    $phieu->save();

                    $ba = Ban::find($phieuorder->idban);
                    $ba->trangthai = 0;
                    $ba->save();

                    $tong = 0;
                    foreach($chitietphieu as $value){
                        $tong += $value->ThucDon->giatien * $value->soluong;
                    }
                    $hoadon = new HoaDon;
                    $hoadon->idphieu = $phieuorder->id;
                    $hoadon->thoigiantao = now();
                    $hoadon->tongtien = $tong + $phieuorder->Ban->phuphi;
                    $hoadon->trangthai = 1;
                    $hoadon->save();
                    $mahd = $hoadon->id;

                    return view("Pages.HoaDon.index", compact("chitietphieu", "phieuorder", "mahd"));
                }
                
                
            }
            
            
        }
        catch (Exception $e) {
            return  $e->getMessage();
        }
        
    }

    public function chuyentrangthaidatban(Request $re){
        $datban = DatBan::find($re->iddatban);
        $datban->trangthai = 1;
        if ($datban->save()){
            return 1;
        }
        return 0;
    }
}
