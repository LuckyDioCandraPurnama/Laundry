<?php

namespace App\Http\Controllers;

use App\User;
use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));
    }
 
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user','token'),201);
    }
 
    public function getAuthenticatedUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }

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
