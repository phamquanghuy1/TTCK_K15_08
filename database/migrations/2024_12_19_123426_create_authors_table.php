<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsTable extends Migration
{
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('affiliation')->nullable();
            $table->timestamps();

            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('authors');
    }
}
