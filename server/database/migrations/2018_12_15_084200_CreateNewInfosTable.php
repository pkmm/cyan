<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->unsignedBigInteger('title_crc32')->index();
            $table->string('url')->comment('新闻详情的地址');
            $table->text("detail");
            $table->timestamp('post_at')->comment('新闻发表的时间');

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
        Schema::dropIfExists('new_infos');
    }
}
