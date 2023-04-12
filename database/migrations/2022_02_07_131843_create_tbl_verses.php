<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblVerses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_verses', function (Blueprint $table) {
            $table->id();
            $table->integer('surah_id')->unsigned();
            $table->string('index',100);
            $table->text('content_indopak');
            $table->text('content_utsmani');
            $table->text('latin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_verses');
    }
}
