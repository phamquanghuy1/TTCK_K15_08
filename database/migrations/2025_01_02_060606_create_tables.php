<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTables extends Migration
{
    public function up()
    {
        Schema::create('don_vi', function (Blueprint $table) {
            $table->id();
            $table->string('ten_don_vi');
            $table->string('dia_chi');
            $table->string('email');
            $table->string('dien_thoai');
            $table->timestamps();
        });

        Schema::create('footer', function (Blueprint $table) {
            $table->id();
            $table->string('thanh_vien');
            $table->string('email');
            $table->string('so_dien_thoai');
            $table->string('dia_chi');
            $table->timestamps();
        });

        Schema::create('danh_muc', function (Blueprint $table) {
            $table->id();
            $table->string('ten_danh_muc');
            $table->timestamps();
        });

        Schema::create('de_tai', function (Blueprint $table) {
            $table->id();
            $table->string('ten_de_tai');
            $table->decimal('kinh_phi', 15, 2);
            $table->text('noi_dung_nghien_cuu');
            $table->dateTime('tu_ngay')->useCurrent();
            $table->dateTime('den_ngay')->useCurrent();
            $table->unsignedBigInteger('ma_don_vi');
            $table->unsignedBigInteger('ma_danh_muc');
            $table->foreign('ma_don_vi')->references('id')->on('don_vi')->cascadeOnDelete();
            $table->foreign('ma_danh_muc')->references('id')->on('danh_muc')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('can_bo', function (Blueprint $table) {
            $table->id();
            $table->string('ten_can_bo');
            $table->string('gioi_tinh');
            $table->string('dien_thoai');
            $table->string('email');
            $table->unsignedBigInteger('ma_don_vi');
            $table->foreign('ma_don_vi')->references('id')->on('don_vi')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('sinh_vien', function (Blueprint $table) {
            $table->id();
            $table->string('ten_sinh_vien');
            $table->string('gioi_tinh');
            $table->string('dien_thoai');
            $table->string('email');
            $table->unsignedBigInteger('ma_don_vi');
            $table->foreign('ma_don_vi')->references('id')->on('don_vi')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('dang_ky_de_tai_cb', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ma_de_tai');
            $table->unsignedBigInteger('ma_can_bo');
            $table->dateTime('ngay_dang_ky')->useCurrent();
            $table->text('ban_dang_ky');
            $table->text('ban_de_cuong_chi_tiet');
            $table->text('ghi_chu')->nullable();
            $table->timestamps();

            $table->foreign('ma_de_tai')->references('id')->on('de_tai')->cascadeOnDelete();
            $table->foreign('ma_can_bo')->references('id')->on('can_bo')->cascadeOnDelete();
        });

        Schema::create('dang_ky_de_tai_sv', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ma_de_tai');
            $table->unsignedBigInteger('ma_sinh_vien');
            $table->dateTime('ngay_dang_ky')->useCurrent();
            $table->text('ban_dang_ky');
            $table->text('ban_de_cuong_chi_tiet');
            $table->text('ghi_chu')->nullable();
            $table->timestamps();

            $table->foreign('ma_de_tai')->references('id')->on('de_tai')->cascadeOnDelete();
            $table->foreign('ma_sinh_vien')->references('id')->on('sinh_vien')->cascadeOnDelete();
        });

        Schema::create('danh_sach_cb_nghien_cuu_dt', function (Blueprint $table) {
            $table->unsignedBigInteger('ma_de_tai');
            $table->unsignedBigInteger('ma_can_bo');
            $table->timestamps();

            $table->foreign('ma_de_tai')->references('id')->on('de_tai')->cascadeOnDelete();
            $table->foreign('ma_can_bo')->references('id')->on('can_bo')->cascadeOnDelete();
        });

        Schema::create('danh_sach_sv_nghien_cuu_dt', function (Blueprint $table) {
            $table->unsignedBigInteger('ma_de_tai');
            $table->unsignedBigInteger('ma_sinh_vien');
            $table->timestamps();

            $table->foreign('ma_de_tai')->references('id')->on('de_tai')->cascadeOnDelete();
            $table->foreign('ma_sinh_vien')->references('id')->on('sinh_vien')->cascadeOnDelete();
        });

        Schema::create('danh_sach_cb_huong_dan_dt', function (Blueprint $table) {
            $table->unsignedBigInteger('ma_de_tai');
            $table->unsignedBigInteger('ma_can_bo');
            $table->timestamps();

            $table->foreign('ma_de_tai')->references('id')->on('de_tai')->cascadeOnDelete();
            $table->foreign('ma_can_bo')->references('id')->on('can_bo')->cascadeOnDelete();
        });

        Schema::create('bao_cao_tien_do_cb', function (Blueprint $table) {
            $table->unsignedBigInteger('ma_can_bo');
            $table->unsignedBigInteger('ma_de_tai');
            $table->integer('lan_bao_cao');
            $table->dateTime('ngay_bao_cao')->useCurrent();
            $table->text('noi_dung');
            $table->text('ket_qua');
            $table->timestamps();

            $table->foreign('ma_can_bo')->references('id')->on('can_bo')->cascadeOnDelete();
            $table->foreign('ma_de_tai')->references('id')->on('de_tai')->cascadeOnDelete();
        });

        Schema::create('bao_cao_tien_do_sv', function (Blueprint $table) {
            $table->unsignedBigInteger('ma_sinh_vien');
            $table->unsignedBigInteger('ma_de_tai');
            $table->integer('lan_bao_cao');
            $table->dateTime('ngay_bao_cao')->useCurrent();
            $table->text('noi_dung');
            $table->text('ket_qua');
            $table->timestamps();

            $table->foreign('ma_sinh_vien')->references('id')->on('sinh_vien')->cascadeOnDelete();
            $table->foreign('ma_de_tai')->references('id')->on('de_tai')->cascadeOnDelete();
        });

        Schema::create('quyet_dinh_nghiem_thu_cb', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ma_de_tai');
            $table->unsignedBigInteger('ma_can_bo');
            $table->dateTime('ngay_quyet_dinh')->useCurrent();
            $table->dateTime('ngay_nghiem_thu')->useCurrent();
            $table->timestamps();

            $table->foreign('ma_de_tai')->references('id')->on('de_tai')->cascadeOnDelete();
            $table->foreign('ma_can_bo')->references('id')->on('can_bo')->cascadeOnDelete();
        });

        Schema::create('quyet_dinh_nghiem_thu_sv', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ma_de_tai');
            $table->unsignedBigInteger('ma_sinh_vien');
            $table->dateTime('ngay_quyet_dinh')->useCurrent();
            $table->dateTime('ngay_nghiem_thu')->useCurrent();
            $table->timestamps();

            $table->foreign('ma_de_tai')->references('id')->on('de_tai')->cascadeOnDelete();
            $table->foreign('ma_sinh_vien')->references('id')->on('sinh_vien')->cascadeOnDelete();
        });

        Schema::create('hoi_dong_nghiem_thu', function (Blueprint $table) {
            $table->unsignedBigInteger('ma_quyet_dinh');
            $table->unsignedBigInteger('ma_can_bo');
            $table->unsignedBigInteger('ma_de_tai');
            $table->string('chuc_danh_nghiem_thu');
            $table->timestamps();

            $table->foreign('ma_quyet_dinh')->references('id')->on('quyet_dinh_nghiem_thu_cb')->cascadeOnDelete();
            $table->foreign('ma_can_bo')->references('id')->on('can_bo')->cascadeOnDelete();
            $table->foreign('ma_de_tai')->references('id')->on('de_tai')->cascadeOnDelete();
        });

        Schema::create('ket_qua_bao_ve_cb', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ma_can_bo');
            $table->unsignedBigInteger('ma_de_tai');
            $table->dateTime('ngay_bao_ve')->useCurrent();
            $table->text('ket_qua');
            $table->text('phieu_ket_qua');
            $table->timestamps();

            $table->foreign('ma_can_bo')->references('id')->on('can_bo')->cascadeOnDelete();
            $table->foreign('ma_de_tai')->references('id')->on('de_tai')->cascadeOnDelete();
        });

        Schema::create('ket_qua_bao_ve_sv', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ma_sinh_vien');
            $table->unsignedBigInteger('ma_de_tai');
            $table->dateTime('ngay_bao_ve')->useCurrent();
            $table->text('ket_qua');
            $table->text('phieu_ket_qua');
            $table->timestamps();

            $table->foreign('ma_sinh_vien')->references('id')->on('sinh_vien')->cascadeOnDelete();
            $table->foreign('ma_de_tai')->references('id')->on('de_tai')->cascadeOnDelete();
        });

        Schema::create('bai_bao_khoa_hoc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ma_de_tai');
            $table->string('tieu_de');
            $table->string('tac_gia');
            $table->dateTime('ngay_phat_hanh')->useCurrent();
            $table->unsignedBigInteger('ma_don_vi');
            $table->unsignedBigInteger('ma_danh_muc');
            $table->text('noi_dung');
            $table->string('img');
            $table->timestamps();

            $table->foreign('ma_de_tai')->references('id')->on('de_tai')->cascadeOnDelete();
            $table->foreign('ma_don_vi')->references('id')->on('don_vi')->cascadeOnDelete();
            $table->foreign('ma_danh_muc')->references('id')->on('danh_muc')->cascadeOnDelete();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('ten_nguoi_dung');
            $table->string('so_dien_thoai');
            $table->string('email')->unique();
            $table->string('mat_khau');
            $table->unsignedBigInteger('ma_don_vi');
            $table->enum('chuc_vu', ['CanBo', 'SinhVien','Không'])->default('Không');
            $table->enum('phan_quyen', ['user', 'admin'])->default('user');
            $table->string('avatar')->nullable();
            $table->timestamps();

            $table->foreign('ma_don_vi')->references('id')->on('don_vi')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('bai_bao_khoa_hoc');
        Schema::dropIfExists('ket_qua_bao_ve_sv');
        Schema::dropIfExists('ket_qua_bao_ve_cb');
        Schema::dropIfExists('hoi_dong_nghiem_thu');
        Schema::dropIfExists('quyet_dinh_nghiem_thu_sv');
        Schema::dropIfExists('quyet_dinh_nghiem_thu_cb');
        Schema::dropIfExists('bao_cao_tien_do_sv');
        Schema::dropIfExists('bao_cao_tien_do_cb');
        Schema::dropIfExists('danh_sach_cb_huong_dan_dt');
        Schema::dropIfExists('danh_sach_sv_nghien_cuu_dt');
        Schema::dropIfExists('danh_sach_cb_nghien_cuu_dt');
        Schema::dropIfExists('dang_ky_de_tai_sv');
        Schema::dropIfExists('dang_ky_de_tai_cb');
        Schema::dropIfExists('sinh_vien');
        Schema::dropIfExists('can_bo');
        Schema::dropIfExists('de_tai');
        Schema::dropIfExists('danh_muc');
        Schema::dropIfExists('don_vi');
    }
}
