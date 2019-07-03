<?php

namespace App\Http\Controllers\MyControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\NvPhucVu\NvPhucVuRepoInterface;
use Illuminate\Support\Facades\DB;
use App\Validators\NvPhucVuValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Validators\BaseValidatorInterface;

class NvPhucVuController extends Controller
{
    protected $NvPhucVuRepo;
    protected $NvPhucVuValiDate;

    public function __construct(NvPhucVuRepoInterface $var){
        $this->NvPhucVuRepo = $var;
    }

    public function index(Request $request)
    {
        $search = [];

        if ($request->id != '') {
            $search[] = ['id', $request->id];
        }

        if ($request->ten != '') {
            $search[] = ['ten', 'like', "%{$request->query('ten')}%"];
        }

        if ($request->has('loai')) {
            switch ($request->query('loai')) {
                case __('Đồ Ăn'):
                    $search[] = ['loai', LOAI_MON_DO_AN];
                    break;
                case __('Nước Uống'):
                    $search[] = ['loai', LOAI_MON_NUOC_UONG];
                    break;
                default:
                    break;
            }
        }

        $monans = $this->NvPhucVuRepo->scopeQuery(function ($query) use ($search) {
            return $query
                ->where($search);
        });

        // $monans = $monans->get();
        // dd($monans);
        $monans = $monans->paginate(5);

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
        
        // if(empty($data))
            $data = [];
        
        return view("Pages.NvPhucVu.index", compact('data', 'monans'));
    }

    
    public function taophieu(Request $request)
    {
        
    }

    public function datban(Request $request)
    {
        
    }
}
