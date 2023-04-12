<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblLessons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_lessons', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('title',100);
            $table->string('speaker',225);
            $table->text('description');
            $table->text('poster');
            $table->string('url_youtube',225);
            $table->boolean('is_recommended');
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
        Schema::dropIfExists('tbl_lessons');
    }
}
