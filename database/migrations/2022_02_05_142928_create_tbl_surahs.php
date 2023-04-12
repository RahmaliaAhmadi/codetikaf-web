<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSurahs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_surahs', function (Blueprint $table) {
            $table->id();
            $table->integer('section_id')->unsigned();
            $table->string('index',100);
            $table->string('name', 225);
            $table->integer('coun_serve');
            $table->string('type', 100);
            $table->string('lafadz', 100);
            $table->string('translate_name', 100);
            $table->boolean('use_bismillah');
            $table->timestamps();

            $table->foreign('section_id')->references('index')->on('master_sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_surahs');
    }
}
