<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    use HasFactory;
    protected $table = 'danh_mucs';
    protected $fillable = [
        'ten_danh_muc',
    ];

    public function deTai()
    {
        return $this->hasMany(DeTai::class, 'ma_danh_muc');
    }
    public function baiBaoKhoaHocs()
    {
        return $this->hasMany(BaiBaoKhoaHoc::class, 'ma_danh_muc');
    }
}
