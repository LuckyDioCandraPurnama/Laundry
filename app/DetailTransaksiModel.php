<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksiModel extends Model
{
    protected $table = 'tb_detail_transaksi';
    public $timestamps = false;
    protected $fillable = ['id_transaksi','id_paket','qty','keterangan'];
}
