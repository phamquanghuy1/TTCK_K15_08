<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanBo extends Model
{
    use HasFactory;
    protected $table = 'can_bo';
    protected $fillable = [
        'ten_can_bo',
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
