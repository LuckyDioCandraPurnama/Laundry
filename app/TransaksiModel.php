<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiModel extends Model
{
    protected $table = 'tb_transaksi';
    public $timestamps = false;
    protected $fillable = [ 'id_member', 'tgl', 'batas_waktu','tgl_bayar','status','dibayar','id_user'];
}
