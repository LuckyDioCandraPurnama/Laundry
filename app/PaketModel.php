<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaketModel extends Model
{
    protected $table = 'tb_paket';
    public $timestamps = false;
    protected $fillable = [	'jenis'	,'nama_paket','harga'];
}
