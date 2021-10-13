<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();

// Route::post('/member','MemberController@member');
// Route::post('/bayar','TransaksiController@bayar');
// Route::post('/user','UserController@user');
// Route::post('/paket','PaketController@paket');
// Route::post('/detail','DetailTransaksiController@detail');

// MEMBER
Route::get("/get_member", "MemberController@index");
Route::get("/get_detail_member/{id_member}", "MemberController@detailmember");
Route::post('/member', 'MemberController@insert_member');
Route::put("/edit_member/{id_member}", "MemberController@update_member");
Route::delete("/delete_member/{id}", "MemberController@delete_member");

// USER
Route::get("/get_user", "UserController@index");
Route::get("/get_detail_user/{id_user}", "UserController@detailuser");
Route::post('/user', 'UserController@insert_user');
Route::put("/edit_user/{id_user}", "UserController@update_user");
Route::delete("/delete_user/{id}", "UserController@delete_user");

// PAKET
Route::get("/get_paket", "PaketController@index");
Route::get("/get_detail_paket/{id_paket}", "PaketController@detailpaket");
Route::post('/paket', 'PaketController@insert_paket');
Route::put("/edit_paket/{id_paket}", "PaketController@update_paket");
Route::delete("/delete_paket/{id}", "PaketController@delete_paket");

// TRANSAKSI
Route::get("/get_transaksi", "TransaksiController@index");
Route::get("/get_detail_transaksi/{id_transaksi}", "TransaksiController@detailtransaksi");
Route::post('/transaksi', 'TransaksiController@insert_transaksi');
Route::put("/edit_transaksi/{id_transaksi}", "TransaksiController@update_transaksi");
Route::delete("/delete_transaksi/{id}", "TransaksiController@delete_transaksi");

// DETAIL TRANSAKSI
Route::get("/get_detail_transaksi", "DetailTransaksiController@index");
Route::get("/get_detail_detail_transaksi/{id_detail_transaksi}", "DetailTransaksiController@detaildetail");
Route::post('/detail_transaksi', 'DetailTransaksiController@insert_detail');
Route::put("/edit_detail_transaksi/{id_detail_transaksi}", "DetailTransaksiController@update_detail");
Route::delete("/delete_detail_transaksi/{id}", "DetailTransaksiController@delete_detail");

