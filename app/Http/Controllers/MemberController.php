<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MemberModel;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function index()
    {
        $data = MemberModel::get();
        return response()->json($data);
    }
    public function detailmember($id_member)
    {
        $detail = MemberModel::where('id_member', $id_member)->first();
        return Response()->json($detail);
    }

    public function insert_member(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'telp' => 'required',
        ] );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $simpan = MemberModel::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'telp' => $request->telp,
        ]);
        if($simpan){
            return Response()->json(['status' => 'Berhasil']);
        }else{
            return Response()->json(['status' => 'Gagal']);
        }
    }

    public function update_produk($id_member, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'telp' => 'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $simpan = MemberModel::where('id_member', $id_member)->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'telp' => $request->telp,
        ]);
        if($simpan){
            return Response()->json(['status' => 'Berhasil']);
        }else{
            return Response()->json(['status' => 'Gagal']);
        }
    }

    public function delete_produk($id_member)
    {
        $hapus = MemberModel::where('id_member', $id_member)->delete();
        if($hapus){
            return Response()->json(['status' => 'Berhasil delete data']);
        }else{
            return Response()->json(['status' => 'Gagal delete data']);
        }
    }

}
