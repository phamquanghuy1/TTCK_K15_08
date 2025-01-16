<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    use HasFactory;
    protected $table = 'sinh_viens';
    protected $fillable = [
        'trang_thai',
        'ten_sinh_vien',
        'gioi_tinh',
        'dien_thoai',
        'email',
        'ma_don_vi',
    ];

    public function donVi()
    {
        return $this->belongsTo(DonVi::class, 'ma_don_vi');
    }
}
