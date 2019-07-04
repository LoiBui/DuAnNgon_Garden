<?php

namespace App\Http\Controllers\MyControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ThucDon\ThucDonRepoInterface;
use Illuminate\Support\Facades\DB;
use App\Model\ThucDon;
use App\Model\PhieuOrder;
use App\Model\ChiTietPhieu;
// use App\Validators\ThucDonValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Validators\BaseValidatorInterface;

class NvPhucVuController extends Controller
{
    protected $ThucDonRepo;
    protected $ThucDonValiDate;

    public function __construct(ThucDonRepoInterface $var){
        $this->ThucDonRepo = $var;
    }

    public function index(Request $request)
    {
        $search = [];

        if ($request->idban != '') {
            $search[] = ['idban', $request->idban];
        }

        $phieuorders = PhieuOrder::where($search)->paginate(10);

        if(empty($phieuorders))
            $phieuorders = [];

        return view("Pages.NvPhucVu.index", compact('phieuorders'));
    }

    public function datmon(Request $request)
    {
        $search = [];

        if ($request->idban != '') {
            $search[] = ['idban', $request->idban];
        }

        $monans = ThucDon::where($search)->paginate(10);

        if(empty($monans))
            $monans = [];
        
        return view("Pages.NvPhucVu.datmon", compact('monans'));
    }
}
