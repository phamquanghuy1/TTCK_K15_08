<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhSachCBHuongDanDT extends Model
{
    use HasFactory;
    protected $table = 'danh_sach_cb_huong_dan_dt';
    protected $fillable = [
        'ma_de_tai',
        'ma_can_bo',
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
