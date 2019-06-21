<?php

namespace App\Http\Controllers\MyControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\TaiKhoan\TaiKhoanRepoInterFace;

class TaiKhoanController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $taikhoan;

    public function __construct(TaiKhoanRepoInterFace $TaiKhoanRepoInterFace)
    {
        parent::__construct();
        $this->taikhoan = $TaiKhoanRepoInterFace;
    }
    public function index()
    {
        $data = $this->taikhoan->all();
        return view('Pages.TaiKhoan.DanhSach', compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        if($this->taikhoan->update($request->data)){
            return $this->response["SUCCESS"];
        }
        return $this->response["FAIL"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->taikhoan->destroy($id)){
            return $this->response["SUCCESS"];
        }
        return $this->response["FAIL"];
    }
}
