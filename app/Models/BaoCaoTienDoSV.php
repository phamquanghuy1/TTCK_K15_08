<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaoCaoTienDoSV extends Model
{
    use HasFactory;
    protected $table = 'bao_cao_tien_do_sv';
    protected $fillable = [
        'ma_sinh_vien',
        'ma_de_tai',
        'lan_bao_cao',
        'ngay_bao_cao',
        'noi_dung',
        'ket_qua',
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
