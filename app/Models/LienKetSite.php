<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LienKetSite extends Model
{
    use HasFactory;
    protected $table = 'lien_ket_sites';
    protected $fillable = [
        'trang_thai',
        'tieu_de',
        'img',
        'lien_ket',
    ];
}
