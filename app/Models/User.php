<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'trang_thai',
        'ten_nguoi_dung',
        'so_dien_thoai',
        'email',
        'mat_khau',
        'ma_don_vi',
        'chuc_vu',
        'phan_quyen',
        'avatar',
    ];

    protected $hidden = [
        'mat_khau', 'remember_token',
    ];
    public function getAuthPassword()
    {
        return $this->mat_khau;
    }

    public function donVi()
    {
        return $this->belongsTo(DonVi::class, 'ma_don_vi');
    }
    public function passwordResets()
    {
        return $this->hasMany(PasswordResetToken::class, 'email', 'email');
    }
}
