<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoiDongNghiemThu extends Model
{
    use HasFactory;
    protected $table = 'hoi_dong_nghiem_thus';
    protected $fillable = [
        'ma_quyet_dinh',
        'ma_can_bo',
        'ma_de_tai',
        'chuc_danh_nghiem_thu',
    ];

    public function quyetDinh()
    {
        return $this->belongsTo(QuyetDinhNghiemThuCB::class, 'ma_quyet_dinh');
    }

    public function canBo()
    {
        return $this->belongsTo(CanBo::class, 'ma_can_bo');
    }

    public function deTai()
    {
        return $this->belongsTo(DeTai::class, 'ma_de_tai');
    }
}
