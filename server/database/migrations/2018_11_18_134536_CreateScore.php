<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('scores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('student_id')->index();
            $table->string('xn', 20);
            $table->tinyInteger('xq');
            $table->string('kcmc', 50);
            $table->string('type');
            $table->string('cj');
            $table->double('jd');
            $table->double('xf');
            $table->string('bkcj')->nullable();
            $table->string('cxcj')->nullable();
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
        \Schema::dropIfExists('scores');
    }
}
