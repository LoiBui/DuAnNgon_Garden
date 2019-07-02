<?php

namespace App\Http\Controllers\MyControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\LeTan\LeTanRepoInterface;

class LeTanController extends Controller
{
    protected $LeTanRepo;

    public function __construct(LeTanRepoInterface $var){
        $this->LeTanRepo = $var;
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
                    $search[] = ['trangthai', 0];
                    break;
                case __('Đã Đặt'):
                    $search[] = ['trangthai', 1];
                    break;
                case __('Đang Sử Dụng'):
                    $search[] = ['trangthai', 2];
                    break;    
                default:
                    break;
            }
        }

        $bans = $this->LeTanRepo->scopeQuery(function ($query) use ($search) {
            return $query
                ->where($search);
        });

        $bans = $bans->paginate(10);

        foreach ($bans as $key => $value) {
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
            else {
                $data[] = array_merge($value->toArray(), [
                    'ngaydat' => '', 
                    'giodat' => '', 
                    'tenkhachhang' => '',
                    'sdt' => ''
                ]);
            }
        }
        // dd($bans);
        if(empty($data))
            $data = [];
        
        return view("Pages.Letan.index", compact('data', 'bans'));
    }

    
    public function taophieu($idban)
    {
        
    }
}
