<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeTai extends Model
{
    use HasFactory;
    protected $table = 'de_tais';
    protected $fillable = [
        'trang_thai',
        'ten_de_tai',
        'kinh_phi',
        'noi_dung_nghien_cuu',
        'tu_ngay',
        'den_ngay',
        'ma_don_vi',
        'ma_danh_muc',
    ];

    public function donVi()
    {
        return $this->belongsTo(DonVi::class, 'ma_don_vi');
    }
    public function danhMuc()
    {
        return $this->belongsTo(DanhMuc::class, 'ma_danh_muc');
    }
}
