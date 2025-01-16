<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KetQuaBaoVeSV extends Model
{
    use HasFactory;
    protected $table = 'ket_qua_bao_ve_svs';
    protected $fillable = [
        'ma_sinh_vien',
        'ma_de_tai',
        'ngay_bao_ve',
        'ket_qua',
        'phieu_ket_qua',
    ];

    public function sinhVien()
    {
        return $this->belongsTo(SinhVien::class, 'ma_sinh_vien');
    }

    public function deTai()
    {
        return $this->belongsTo(DeTai::class, 'ma_de_tai');
    }
}
