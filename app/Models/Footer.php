<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;
    protected $table = 'footers';
    protected $fillable = [
        'thanh_vien',
        'email',
        'so_dien_thoai',
        'dia_chi',
    ];
}
