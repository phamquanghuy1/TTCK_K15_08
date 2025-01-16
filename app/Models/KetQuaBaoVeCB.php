<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KetQuaBaoVeCB extends Model
{
    use HasFactory;
    protected $table = 'ket_qua_bao_ve_cbs';
    protected $fillable = [
        'ma_can_bo',
        'ma_de_tai',
        'ngay_bao_ve',
        'ket_qua',
        'phieu_ket_qua',
    ];

    public function canBo()
    {
        return $this->belongsTo(CanBo::class, 'ma_can_bo');
    }

    public function deTai()
    {
        return $this->belongsTo(DeTai::class, 'ma_de_tai');
    }
}
