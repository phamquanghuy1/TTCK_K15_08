<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'in_progress','completed'])->default('pending');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('category_id');
            $table->text('noi_dung')->nullable();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('authors')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
