<?php

namespace App\Http\Controllers\MyControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ThucDon\ThucDonRepoInterface;
use Illuminate\Support\Facades\DB;
use App\Model\ThucDon;
use App\Model\PhieuOrder;
use App\Model\ChiTietPhieu;

use App\Validators\ChiTietPhieuValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Validators\BaseValidatorInterface;

class NvPhucVuController extends Controller
{
    protected $ThucDonRepo;
    protected $ChiTietPhieuValiDate;

    public function __construct(ThucDonRepoInterface $var, ChiTietPhieuValidator $vali){
        $this->ThucDonRepo = $var;
        $this->ChiTietPhieuValiDate = $vali;
    }

    public function index(Request $request)
    {
        $search = [];

        if ($request->idban != '') {
            $search[] = ['idban', $request->idban];
        }

        $phieuorders = PhieuOrder::where($search)->paginate(10);
        foreach ($phieuorders as $key => $value) {
            $tennhanvien = $value->NhanVien()->first()->tennguoidung;
            if(!empty($tennhanvien))
            {
                $data[] = array_merge($value->toArray(), [
                    'tennhanvien' => $tennhanvien, 
                ]);
            }
        }

        if(empty($data))
            $data = [];

        return view("Pages.NvPhucVu.index", compact('data', 'phieuorders'));
    }

    public function datmon(Request $request, $idphieuorder)
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

        $monans = ThucDon::where($search)->paginate(10);

        $ChiTietPhieu = ChiTietPhieu::where('idphieuorder', $idphieuorder)->get();
        foreach ($ChiTietPhieu as $key => $value) {
            $thucdon = $value->ThucDon()->first();
            if(!empty($thucdon))
            {
                $monanorders[] = array_merge($value->toArray(), [
                    'tenmon' => $thucdon->ten, 
                    'loai' => $thucdon->loai, 
                    'giatien' => $thucdon->giatien,
                ]);
            }
        }

        if(empty($monanorders))
            $monanorders = [];

        if(empty($monans))
            $monans = [];
        
        return view("Pages.NvPhucVu.datmon", compact('monans', 'monanorders', 'idphieuorder'));
    }

    public function themmon(Request $request, $idphieuorder, $idmon)
    {
        try {
            $data = $request->all();
    
            $this->ChiTietPhieuValiDate->with($data)->passesOrFail(BaseValidatorInterface::RULE_CREATE);

            $data = array_merge($data, [
                'idphieuorder' => $idphieuorder, 
                'idmon' => $idmon, 
                'trangthai' => TRANG_THAI_MON_CHUA_LAM,
            ]);
            unset($data['_token']);

            if(DB::table('chitietphieus')->insert($data))
                $request->session()->flash('thongbao', __('Đặt Món Thành Công'));
            return redirect(route('nvphucvu.datmon', $idphieuorder));
        } catch (ValidatorException $e) {
            $request->session()->flash('thongbao', __('Đặt Món Thất Bại'));
            return redirect(route('nvphucvu.datmon', $idphieuorder))->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function suamon(Request $request, $idphieuorder, $idchitietphieuorder)
    {
        try {
            $data = $request->all();
            unset($data['_token']);
            $this->ChiTietPhieuValiDate->with($data)->passesOrFail(BaseValidatorInterface::RULE_CREATE);

            if(DB::table('chitietphieus')->update($data, $idchitietphieuorder))
                $request->session()->flash('thongbao', __('Sửa Món Thành Công'));
            return redirect(route('nvphucvu.datmon', $idphieuorder));
        } catch (ValidatorException $e) {
            $request->session()->flash('thongbao', __('Sửa Món Thất Bại'));
            return redirect(route('nvphucvu.datmon', $idphieuorder))->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function xoamon($idphieuorder, $idchitietphieuorder)
    {
        try {
            if (DB::table('chitietphieus')->where('id', $idchitietphieuorder)->delete()) {
                request()->session()->flash('thongbao', __('Xóa Món Thành Công'));
                return redirect(route('nvphucvu.datmon', [$idphieuorder]));
            }
        } catch (\Exception $e) {
            dd($e);
        }

        request()->session()->flash('thongbao', __('Xóa Món Thất Bại'));
        return redirect(route('nvphucvu.datmon', [$idphieuorder]));
    }

    public function ajax(Request $request)
    {
        $ChiTietPhieu = ChiTietPhieu::where('idphieuorder', $request->idphieuorder)->get();
        foreach ($ChiTietPhieu as $key => $value) {
            $thucdon = $value->ThucDon()->first();
            if(!empty($thucdon))
            {
                $monanorders[] = array_merge($value->toArray(), [
                    'tenmon' => $thucdon->ten, 
                    'loai' => $thucdon->loai, 
                    'giatien' => $thucdon->giatien,
                ]);
            }
        }

        if (empty($monanorders)) {
            return response()->json(['success' => false, 'data' => [] ]);
        }

        return response()->json(['success' => true, 'data' => $monanorders]);
    }
}
