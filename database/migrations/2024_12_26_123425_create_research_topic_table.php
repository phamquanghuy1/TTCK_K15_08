<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('research_topic', function (Blueprint $table) {
            $table->id();
            $table->string('ten_de_tai');
            $table->text('muc_tieu_de_tai');
            $table->text('ket_qua_dat_duoc');
            $table->text('san_pham_de_tai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research_topic');
    }
};
