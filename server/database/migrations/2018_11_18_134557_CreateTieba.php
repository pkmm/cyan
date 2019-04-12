<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTieba extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('tiebas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tieba_user_id')->index();
            $table->string('kw');
            $table->integer('fid');
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
        //
    }
}
