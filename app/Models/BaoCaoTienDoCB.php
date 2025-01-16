<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaoCaoTienDoCB extends Model
{
    use HasFactory;
    protected $table = 'bao_cao_tien_do_cbs';
    protected $fillable = [
        'ma_can_bo',
        'ma_de_tai',
        'lan_bao_cao',
        'ngay_bao_cao',
        'noi_dung',
        'ket_qua',
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
