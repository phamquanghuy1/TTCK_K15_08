<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = new User();
        $user->ten_nguoi_dung = 'admin';
        $user->so_dien_thoai = '0123456789';
        $user->email = 'admin@gmail.com';
        $user->mat_khau = bcrypt('admin');
        $user->ma_don_vi = 1;
        $user->chuc_vu = 'Không';
        $user->phan_quyen = 'admin';
        $user->save();

        $user = new User();
        $user->ten_nguoi_dung = 'user';
        $user->so_dien_thoai = '0888881401';
        $user->email = 'user@gmail.com';
        $user->mat_khau = bcrypt('user');
        $user->ma_don_vi = 1;
        $user->chuc_vu = 'SinhVien';
        $user->phan_quyen = 'user';
        $user->save();

        $user = new User();
        $user->ten_nguoi_dung = 'Phạm Quang Huy';
        $user->so_dien_thoai = '0379395645';
        $user->email = 'huypham140103@gmail.com';
        $user->mat_khau = bcrypt('Huy12345');
        $user->ma_don_vi = 1;
        $user->chuc_vu = 'SinhVien';
        $user->phan_quyen = 'user';
        $user->save();
    }
}
