<?php

namespace App\Http\Controllers\MyControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use App\Validators\BanValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Validators\BaseValidatorInterface;
use Illuminate\Support\Facades\DB;
use App\Model\Ban;


class BanController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $ban;

    public function __construct(BanValidator $vali)
    {
        parent::__construct();
        $this->banvalidate = $vali;
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

        $data = Ban::where($search)->paginate(10);

        return view('Pages.Ban.DanhSach', compact("data"));
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
            if (DB::table('bans')->where('id', $id)->delete()) {
                request()->session()->flash('thongbao', __('Xóa Bàn Thành Công'));
                return redirect("ban");
            }
        } catch (\Exception $e) {
            request()->session()->flash('thongbao', __('Xóa Bàn Thất Bại Bàn Đang Có Người Đặt'));
            return redirect("ban");
        }

        request()->session()->flash('thongbao', __('Xóa Bàn Thất Bại'));
        return redirect("ban");
    }
}
