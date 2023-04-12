<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterGeneralInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_general_infos', function (Blueprint $table) {
            $table->id();
            $table->string('title',100);
            $table->text('description');
            $table->text('image');
            $table->string('link',100);
            $table->boolean('is_show');
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
        Schema::dropIfExists('master_general_infos');
    }
}
