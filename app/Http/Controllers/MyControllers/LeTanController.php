<?php

namespace App\Http\Controllers\MyControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\LeTan\LeTanRepoInterface;
use Illuminate\Support\Facades\DB;
use App\Validators\LeTanValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Validators\BaseValidatorInterface;

class LeTanController extends Controller
{
    protected $LeTanRepo;
    protected $LeTanValiDate;

    public function __construct(LeTanRepoInterface $var, LeTanValidator $validate){
        $this->LeTanRepo = $var;
        $this->LeTanValiDate = $validate;
    }

    public function index(Request $request)
    {
        $search = [];

        if ($request->sochongoi != '') {
            $search[] = ['sochongoi', $request->sochongoi];
        }

        if ($request->has('trangthai')) {
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
        }

        $bans = $this->LeTanRepo->scopeQuery(function ($query) use ($search) {
            return $query
                ->where($search);
        });

        $bans = $bans->get();
        // $bans = $bans->paginate(10);

        $search_datban = [];
        if ($request->sdt != '') {
            $search_datban[] = ['sdt', 'like', "%{$request->query('sdt')}%"];
        }

        if ($request->ngaydat != '') {
            $search_datban[] = ['ngaydat', $request->query('ngaydat')];
        }

        foreach ($bans as $key => $value) {
            if($search_datban )
            {
                $datban = $value->datban()->where($search_datban)->first();
                if(!empty($datban))
                {
                    $data[] = array_merge($value->toArray(), [
                        'ngaydat' => $datban->ngaydat, 
                        'giodat' => $datban->giodat, 
                        'tenkhachhang' => $datban->tenkhachhang,
                        'sdt' => $datban->sdt
                    ]);
                }
            }
            else {
                $datban = $value->datban()->first();
                if(!empty($datban))
                {
                    $data[] = array_merge($value->toArray(), [
                        'ngaydat' => $datban->ngaydat, 
                        'giodat' => $datban->giodat, 
                        'tenkhachhang' => $datban->tenkhachhang,
                        'sdt' => $datban->sdt
                    ]);
                }
                else{
                    $data[] = array_merge($value->toArray(), [
                        'ngaydat' => '', 
                        'giodat' => '', 
                        'tenkhachhang' => '',
                        'sdt' => ''
                    ]);
                }
            }
        }
        
        if(empty($data))
            $data = [];
        
        return view("Pages.Letan.index", compact('data', 'bans'));
    }

    
    public function taophieu(Request $request)
    {
        if ($request->has('idban')) {
            $idban = $request->query('idban');
        }
        
        // if(DB::table('phieuorders')->insert([
        //     'idban', $idban,
        //     'idnhanvien', \Auth::user()->id,
        //     'thoigiantao', date('Y-m-d H:i:s')
        // ]))
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

            $this->LeTanValiDate->with($data)->passesOrFail(BaseValidatorInterface::RULE_CREATE);

            
            $data = array_merge($data, [
                'trangthai' => 0,
            ]);

            // $datban = $this->LeTanRepo->create($data);
            if(DB::table('datbans')->insert($data) && DB::table('bans')->where('id', $data['idban'])->update(['trangthai' => 1]))
            {
                $request->session()->flash('thongbao', 'Đặt Bàn Thành Công');
            }
                
            return redirect(route('letan'));
        } catch (ValidatorException $e) {
            $request->session()->flash('thongbao','Đặt Bàn Thất Bại');
            return redirect(route('letan'))->withErrors($e->getMessageBag())->withInput();
        }
    }
}
