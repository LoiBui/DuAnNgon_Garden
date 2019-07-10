<?php

namespace App\Http\Controllers\MyControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ThucDon\ThucDonRepoInterFace;
use App\Model\ThucDon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use DB;
class ThucDonController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $thucdon;
    public function __construct(ThucDonRepoInterFace $ThucDonRepoInterFace)
    {
        parent::__construct();
        $this->thucdon = $ThucDonRepoInterFace;
    }
    public function index()
    {
        //
        $data = $this->thucdon->paginate(12);
        //dd($data);
        return view('Pages/ThucDon/DanhSachThucDon',compact("data"));
    }

    public function search(Request $request)
    {
        //dd($request);
        $data_search = $request->get('data-search');
        $dataSort = $request->get('sort-price');
        
        $data = new ThucDon;
        
        //dd($dataSort);
        if ($dataSort == 1){
            $data = $data->orderByRaw('giatien ASC');
        }else if ($dataSort == 2){
            $data = $data->orderByRaw('giatien DESC');
        }
        
        if ($data_search) {
            //dd($data_search);
            $data = $data->where('ten','LIKE','%'.$data_search.'%');
        }
        $data = $data->paginate(12);
        return view('Pages.ThucDon.DanhSachThucDon',compact('data'));
        
    }

    public function add(Request $request)
    {
        
        if($request->isMethod('post'))
        {
            //dd($request);
            //validator
            $data = $request->all();

            $rules = [
                'namefood' => 'required',
                'pricefood' => 'required',
                'typefood' => 'required',
                'photo1'    => 'mimes:jpeg,png,jpg,JPEG,JPG,PNG|max:5120'
            ];
            $mess = [
                'required' => ':attribute không bỏ trống.',
                'namefood.unique'     => ':attribute ' . $data['namefood'] . ' đã có trong database.',
                'photo1.mimes'     => 'ảnh không phù hợp.',
            ];
            $fieldName = [
                'namefood' => 'Tên món',
                'pricefood' => 'Giá món',
                'typefood' => 'Loại món'
            ];
            $validator = Validator::make($data,$rules,$mess,$fieldName);
            if($validator->fails())
            {
                return redirect()->route('thucdon.add')->withErrors($validator->errors());
            }
            DB::beginTransaction();
            try{
                $thucdon = new ThucDon();
                $thucdon->ten = $request->get('namefood');
                $thucdon->giatien = $request->get('pricefood');
                $thucdon->loai = (int)$request->get('typefood');
                $thucdon->ghichu = $request->get('notefood');

                if ($request->hasFile('photo1')) {
                    $file           = $request->file('photo1');

                    $extension      = $file->getClientOriginalExtension(); // getting excel extension
                    $filename       = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $dir            = public_path('images/thucdon');
                    $filename       = uniqid() . '_' . time() . '_' . date('Ymd') . '_' . $filename . '.' . $extension;
                    $file->move($dir, $filename);
                    // dd($filename);
                    $thucdon->anh = $filename;
                }
                //dd($thucdon);
                $thucdon->save();
                DB::commit();
                session()->flash('thongbao', __('Thêm món thành công'));
                return redirect()->route('thucdon.add');
            }catch(\Exception $e)
            {
                DB::rollBack();
                dd($e);
                exit;
            }
        }
        return view('Pages/ThucDon/ThemThucDon');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $data  = $request->all();
        //dd($data);
        DB::beginTransaction();
            try{
                $fname = "";
                if ($request->hasFile('photo1')) {
                    $file           = $request->file('photo1');

                    $extension      = $file->getClientOriginalExtension(); // getting excel extension
                    $filename       = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $dir            = public_path('images/thucdon');
                    $filename       = uniqid() . '_' . time() . '_' . date('Ymd') . '_' . $filename . '.' . $extension;
                    $file->move($dir, $filename);
                    //dd($filename);
                    $fname  = $filename;
                }
                //dd($fname);
                ThucDon::where('id','=',$data['id'])->update(['anh'=>$fname,'ten'=>$data['namefood'],'giatien'=>$data['pricefood'],'loai'=>$data['typefood'],'ghichu'=>$data['notefood']]);
                DB::commit();
                session()->flash('thongbao', __('Sửa món thành công'));
                return redirect()->route('thucdon');
            }catch(\Exception $e)
            {
                DB::rollBack();
                dd($e);
                exit;
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if($this->thucdon->destroy($id)){
            $request->session()->flash('thongbao','Xóa Thực Đơn Thành Công');
            return redirect("thucdon");
        }
        session()->flash('thongbao', __('Xoá món thành công'));
        return redirect("thucdon");
    }
}
