<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuyetDinhNghiemThuCB extends Model
{
    use HasFactory;
    protected $table = 'quyet_dinh_nghiem_thu_cbs';
    protected $fillable = [
        'ma_de_tai',
        'ma_can_bo',
        'ngay_quyet_dinh',
        'ngay_nghiem_thu',
    ];

    public function deTai()
    {
        return $this->belongsTo(DeTai::class, 'ma_de_tai');
    }

    public function canBo()
    {
        return $this->belongsTo(CanBo::class, 'ma_can_bo');
    }
}
