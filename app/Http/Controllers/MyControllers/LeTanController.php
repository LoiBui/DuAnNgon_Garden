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
use Carbon\Carbon;
use App\Model\Ban;


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
        
        
        // $search_datban = [];
        // if ($request->sdt != '') {
        //     $search_datban[] = ['sdt', 'like', "%{$request->query('sdt')}%"];
        // }

        // if ($request->ngaydat != '') {
        //     $search_datban[] = ['ngaydat', $request->query('ngaydat')];
        // }

        // foreach ($bans as $key => $value) {
        //     if($search_datban )
        //     {
        //         $datban = $value->datban()->where($search_datban)->first();
        //         if(!empty($datban))
        //         {
        //             $data[] = array_merge($value->toArray(), [
        //                 'ngaydat' => $datban->ngaydat, 
        //                 'giodat' => $datban->giodat, 
        //                 'tenkhachhang' => $datban->tenkhachhang,
        //                 'sdt' => $datban->sdt
        //             ]);
        //         }
        //     }
        //     else {
        //         $datban = $value->datban()->first();
        //         if(!empty($datban))
        //         {
        //             $data[] = array_merge($value->toArray(), [
        //                 'ngaydat' => $datban->ngaydat, 
        //                 'giodat' => $datban->giodat, 
        //                 'tenkhachhang' => $datban->tenkhachhang,
        //                 'sdt' => $datban->sdt
        //             ]);
        //         }
        //         else{
        //             $data[] = array_merge($value->toArray(), [
        //                 'ngaydat' => '', 
        //                 'giodat' => '', 
        //                 'tenkhachhang' => '',
        //                 'sdt' => ''
        //             ]);
        //         }
        //     }
        // }
        
        $data = $bans->toArray();

        

        if(empty($data))
            $data = [];
        

            $page = Input::get('page', 1); 

            $perPage = 10;

            $offSet = ($page * $perPage) - $perPage; // Start displaying items from this number

            $itemsForCurrentPage = array_slice($data, $offSet, $perPage, true);

            $data = new LengthAwarePaginator($itemsForCurrentPage, count($data), $perPage, $page, 
        ['path' => request()->url(), 'query' => request()->query()]);
        
        return view("Pages.LeTan.index", compact('data'));
    }

    public function chuyentranthaiban(Request $re){
        $ban = Ban::find($re->idban);
        $ban->trangthai = TRANG_THAI_BAN_DANG_SU_DUNG;
        if ($ban->save()){
            $datban = DatBan::where("idban", $re->idban)->where("ngaydat", $re->ngaydat)->where("giodat", $re->giodat)->first();
            $db = DatBan::find($datban->id);
            $db->trangthai = 2;
            $db->save();
            return 1;
        }
        return 0;
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
}
