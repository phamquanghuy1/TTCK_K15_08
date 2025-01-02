<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhSachSVNghienCuuDT extends Model
{
    use HasFactory;
    protected $table = 'danh_sach_sv_nghien_cuu_dt';
    protected $fillable = [
        'ma_de_tai',
        'ma_sinh_vien',
    ];

    public function deTai()
    {
        return $this->belongsTo(DeTai::class, 'ma_de_tai');
    }

    public function sinhVien()
    {
        return $this->belongsTo(SinhVien::class, 'ma_sinh_vien');
    }
}
