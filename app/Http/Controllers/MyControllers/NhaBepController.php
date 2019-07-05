<?php

namespace App\Http\Controllers\MyControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PhieuOrder;
use App\Model\ChiTietPhieu;
use App\Repositories\PhieuOrder\PhieuOrderRepoInterface;
use App\Repositories\ChiTietPhieu\ChiTietPhieuRepoInterface;

class NhaBepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $PhieuOrder;
    protected $ChiTietPhieu;

    public function __construct(PhieuOrderRepoInterface $var, ChiTietPhieuRepoInterface $ctp){
        $this->PhieuOrder = $var;
        $this->ChiTietPhieu = $ctp;
    }
    public function index()
    {
        return view("Pages.NhaBep.index");
    }

    public function getPhieuorder(){
        $phieuorder = PhieuOrder::orderBy('thoigiantao', 'desc')->get();
        foreach($phieuorder as $key=>$value){
            $value->tennhanvien = $value->NhanVien->tennguoidung;
        }
        return $phieuorder;
    }

    public function getChiTietPhieubyIdPhieuOrder($id){
        $ctphieuorder = $this->ChiTietPhieu->findByIdPhieuOrder($id);
        foreach($ctphieuorder as $value){
            $value->tenmon = $value->ThucDon->ten;
        }
        return $ctphieuorder;
    }

    public function thaydoitrangthaichitietphieu(Request $re){
        $data = ChiTietPhieu::find($re->id);
        $data->trangthai = $re->status;
        $data->save();
    }

    public function thaydoitrangthaiphieuorder(Request $re){
        $data = PhieuOrder::find($re->id);
        $data->trangthai = $re->status;
        $data->save();
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
    public function update(Request $request, $id)
    {
        //
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
    }
}
