<?php

namespace App\Http\Controllers\MyControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\TaiKhoan\TaiKhoanRepoInterFace;
use Hash;
use App\Validators\TaiKhoanValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Validators\BaseValidatorInterface;
use Illuminate\Support\Facades\DB;
use App\Model\TaiKhoan;


class TaiKhoanController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $taikhoan;
    protected $taikhoanvalidate;

    public function __construct(TaiKhoanRepoInterFace $TaiKhoanRepoInterFace, TaiKhoanValidator $vali)
    {
        parent::__construct();
        $this->taikhoan = $TaiKhoanRepoInterFace;
        $this->taikhoanvalidate = $vali;
    }
    public function index(Request $request)
    {
        $search = [];

        if ($request->tennguoidung != '') {
            $search[] = ['tennguoidung', $request->tennguoidung];
        }

        if ($request->sdt != '') {
            $search[] = ['sdt', $request->sdt];
        }

        $data = TaiKhoan::where($search)->paginate(10);

        return view('Pages.TaiKhoan.DanhSach', compact("data"));
    }

    public function dangnhap(Request $request, $guard = 'web'){
        try{
            $auth = Auth()->guard($guard);

            if($auth->attempt(['username'=>$request->tendangnhap, 'password'=>$request->matkhau]))
            {   
                switch (Auth()->guard('web')->user()->quyen) {
                    case QUYEN_ADMIN:
                        return redirect('taikhoan/');
                        break;
                    case QUYEN_NHA_BEP:
                        return redirect('nhabep/');
                        break;
                    case QUYEN_PHUC_VU:
                        return redirect('nvphucvu/');
                        break;
                    case QUYEN_LE_TAN:
                        return redirect('letan/');
                        break;
                    default:
                         return redirect('dashboard');
                        break;
                }
            }

            $request->session()->flash('thongbao', __('Sai tên đăng nhập hoặc mật khẩu'));
            return redirect('dangnhap');
        }catch (ValidatorException $e) {
            return redirect('dangnhap')->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function dangxuat($guard = 'web')
    {            
        Auth()->guard($guard)->logout();
        return redirect("dangnhap");
    }

    
    public function store(Request $request)
    {    
        try {
            $data = $request->all();
            unset($data['_token']);
    
            $this->taikhoanvalidate->with($data)->passesOrFail(BaseValidatorInterface::RULE_CREATE);

            if(DB::table('taikhoans')->insert($data))
            {
                $request->session()->flash('thongbao', __('Thêm Tài Khoản Thành Công'));
                return redirect("taotaikhoan");
            }
        } catch (ValidatorException $e) {
            $request->session()->flash('thongbao', __('Thêm Tài Khoản Thất Bại'));
            return redirect("taotaikhoan")->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function update(Request $request)
    {
        try {
            $data = $request->all();
            unset($data['_token']);

            if ($request->isSua == 1){
                $data["password"] = Hash::make($request->password);
            }
            else {
                unset($data['password']);
            }
            unset($data['isSua']);
            unset($data['xacnhanmatkhau']);

            $this->taikhoanvalidate->with($data)->passesOrFail(BaseValidatorInterface::RULE_UPDATE);
            
            if($this->taikhoan->update($data)){
                $request->session()->flash('thongbao', __('Sửa Tài Khoản Thành Công'));
                return redirect("taikhoan");
            }
        } catch (ValidatorException $e) {
            $request->session()->flash('thongbao', __('Sửa Tài Khoản Thất Bại'));
            return redirect("taikhoan")->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            if (DB::table('taikhoans')->where('id', $id)->delete()) {
                request()->session()->flash('thongbao', __('Xóa Tài Khoản Thành Công'));
                return redirect("taikhoan");
            }
        } catch (\Exception $e) {
            request()->session()->flash('thongbao', __('Xóa Tài Khoản Thất Bại'));
            return redirect("taikhoan");
        }

        request()->session()->flash('thongbao', __('Xóa Tài Khoản Thất Bại'));
        return redirect("taikhoan");
    }

    
}
