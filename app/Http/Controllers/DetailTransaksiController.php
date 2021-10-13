<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetailTransaksiModel;
use Illuminate\Support\Facades\Validator;

class DetailTransaksiController extends Controller
{
    public function index()
    {
        $data = DetailTransaksiModel::get();
        return response()->json($data);
    }
    public function detaildetail($id_detail_transaksi)
    {
        $detail = DetailTransaksiModel::where('id_detail_transaksi', $id_detail_transaksi)->first();
        return Response()->json($detail);
    }

    public function insert_detail(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id_transaksi' => 'required',
            'id_paket' => 'required',
            'qty' => 'required',
            'keterangan' => 'required',
        ] );

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan = DetailTransaksiModel::create([
            'id_transaksi' => $request->id_transaksi,
            'id_paket' => $request->id_paket,
            'qty' => $request->qty,
            'keterangan' => $request->keterangan,

        ]);
        if($simpan){
            return Response()->json(['status' => 'Berhasil']);
        }else{
            return Response()->json(['status' => 'Gagal']);
        }
    }
    public function update_detail($id_detail_transaksi, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_transaksi' => 'required',
            'id_paket' => 'required',
            'qty' => 'required',
            'keterangan' => 'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $simpan = DetailTransaksiModel::where('id_detail_transaksi', $id_detail_transaksi)->update([
                'id_transaksi' => $request->id_transaksi,
                'id_paket' => $request->id_paket,
                'qty' => $request->qty,
                'keterangan' => $request->keterangan,
        ]);
        if($simpan){
            return Response()->json(['status' => 'Berhasil']);
        }else{
            return Response()->json(['status' => 'Gagal']);
        }
    }

    public function delete_detail($id_detail_transaksi)
    {
        $hapus = DetailTransaksiModel::where('id_detail_transaksi', $id_detail_transaksi)->delete();
        if($hapus){
            return Response()->json(['status' => 'Berhasil delete data']);
        }else{
            return Response()->json(['status' => 'Gagal delete data']);
        }
    }
}
