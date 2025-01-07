<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiBaoKhoaHoc extends Model
{
    use HasFactory;

    protected $table = 'bai_bao_khoa_hoc'; // Chỉ định tên bảng chính xác
    protected $fillable = [
        'ma_de_tai',
        'tieu_de',
        'tac_gia',
        'ngay_phat_hanh',
        'ma_don_vi',
        'ma_danh_muc',
        'noi_dung',
        'img',
    ];

    public function deTai()
    {
        return $this->belongsTo(DeTai::class, 'ma_de_tai');
    }

    public function donVi()
    {
        return $this->belongsTo(DonVi::class, 'ma_don_vi');
    }
    public function danhMuc()
    {
        return $this->belongsTo(DanhMuc::class, 'ma_danh_muc');
    }
}
