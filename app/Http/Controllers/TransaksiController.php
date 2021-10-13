<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransaksiModel;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = TransaksiModel::get();
        return response()->json($data);
    }
    public function detailtransaksi($id_transaksi)
    {
        $detail = TransaksiModel::where('id_transaksi', $id_transaksi)->first();
        return Response()->json($detail);
    }

    public function insert_bayar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_member' => 'required',
            'tgl' => 'required',
            'batas_waktu' => 'required',
            'tgl_bayar' => 'required',
            'status' => 'required',
            'dibayar' => 'required',
            'id_user' => 'required',
        ]);
        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }
        $simpan = TransaksiModel::create([
            'id_member' => $request->id_member,
            'tgl' => $request->tgl,
            'batas_waktu' => $request->batas_waktu,
            'tgl_bayar' => $request->tgl_bayar,
            'status' => $request->status,
            'dibayar' => $request->dibayar,
            'id_user' => $request->id_user,
        ]);
        if ($simpan) {
            return Response()->json(['status' => 'Berhasil']);
        } else {
            return Response()->json(['status' => 'Gagal']);
        }
    }

    public function update_transaksi($id_transaksi, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_member' => 'required',
            'tgl' => 'required',
            'batas_waktu' => 'required',
            'tgl_bayar' => 'required',
            'status' => 'required',
            'dibayar' => 'required',
            'id_user' => 'required',
        ]);
        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }
        $simpan = TransaksiModel::where('id_transaksi', $id_transaksi)->update([
            'id_member' => $request->id_member,
            'tgl' => $request->tgl,
            'batas_waktu' => $request->batas_waktu,
            'tgl_bayar' => $request->tgl_bayar,
            'status' => $request->status,
            'dibayar' => $request->dibayar,
            'id_user' => $request->id_user,
        ]);
        if ($simpan) {
            return Response()->json(['status' => 'Berhasil']);
        } else {
            return Response()->json(['status' => 'Gagal']);
        }
    }

    public function delete_transaksi($id_transaksi)
    {
        $hapus = TransaksiModel::where('id_transaksi', $id_transaksi)->delete();
        if ($hapus) {
            return Response()->json(['status' => 'Berhasil delete data']);
        } else {
            return Response()->json(['status' => 'Gagal delete data']);
        }
    }
}
