<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaketModel;
use Illuminate\Support\Facades\Validator;

class PaketController extends Controller
{
    public function index()
    {
        $data = PaketModel::get();
        return response()->json($data);
    }
    public function detailpaket($id_paket)
    {
        $detail = PaketModel::where('id_paket', $id_paket)->first();
        return Response()->json($detail);
    }

    public function insert_paket(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'jenis' => 'required',
            'nama_paket' => 'required',
            'harga' => 'required',
        ] );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $simpan = PaketModel::create([
            'jenis' => $request->jenis,
            'nama_paket' => $request->nama_paket,
            'harga' => $request->harga,
        ]);
        if($simpan){
            return Response()->json(['status' => 'Berhasil']);
        }else{
            return Response()->json(['status' => 'Gagal']);
        }
    }
    public function update_paket($id_paket, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis' => 'required',
            'nama_paket' => 'required',
            'harga' => 'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $simpan = PaketModel::where('id_paket', $id_paket)->update([
            'jenis' => $request->jenis,
            'nama_paket' => $request->nama_paket,
            'harga' => $request->harga,
        ]);
        if($simpan){
            return Response()->json(['status' => 'Berhasil']);
        }else{
            return Response()->json(['status' => 'Gagal']);
        }
    }

    public function delete_paket($id_paket)
    {
        $hapus = PaketModel::where('id_paket', $id_paket)->delete();
        if($hapus){
            return Response()->json(['status' => 'Berhasil delete data']);
        }else{
            return Response()->json(['status' => 'Gagal delete data']);
        }
    }
}
