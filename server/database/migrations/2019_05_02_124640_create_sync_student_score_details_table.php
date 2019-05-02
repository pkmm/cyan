<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyncStudentScoreDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sync_student_score_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('student_id')->unique('uk_student_id');
            $table->string('student_number', '32');
            $table->integer('lesson_count')->default(0);
            $table->string('cost_time');
            $table->string('status')->comment('同步状态描述');
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
        Schema::dropIfExists('sync_student_score_details');
    }
}
