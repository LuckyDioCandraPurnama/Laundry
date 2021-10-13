<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\UserModel;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $data = UserModel::get();
        return response()->json($data);
    }
    public function detailuser($id_user)
    {
        $detail = UserModel::where('id_user', $id_user)->first();
        return Response()->json($detail);
    }

    public function insert_user(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ] );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $simpan = UserModel::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $request->password,
            'role' => $request->role,
        ]);
        if($simpan){
            return Response()->json(['status' => 'Berhasil']);
        }else{
            return Response()->json(['status' => 'Gagal']);
        }
    }
    public function update_user($id_user, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $simpan = UserModel::where('id_user', $id_user)->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => $request->password,
                'role' => $request->role,
        ]);
        if($simpan){
            return Response()->json(['status' => 'Berhasil']);
        }else{
            return Response()->json(['status' => 'Gagal']);
        }
    }

    public function delete_user($id_user)
    {
        $hapus = UserModel::where('id_user', $id_user)->delete();
        if($hapus){
            return Response()->json(['status' => 'Berhasil delete data']);
        }else{
            return Response()->json(['status' => 'Gagal delete data']);
        }
    }
}
