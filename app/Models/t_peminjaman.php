<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_peminjaman extends Model
{
    use HasFactory;
    protected $table = 't_peminjaman';
    protected $table_detail = 't_peminjaman_detail';

}
