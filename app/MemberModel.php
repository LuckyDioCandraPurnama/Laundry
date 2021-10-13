<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberModel extends Model
{
    protected $table = 'tb_member';
    public $timestamps = false;
    protected $fillable = ['nama','alamat','jenis_kelamin','telp'];
}
