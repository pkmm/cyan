<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWeChatUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('wechat_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('idx_user_id');
            $table->string('avatar');
            $table->string('country');
            $table->string('province');
            $table->string('city');
            $table->string('nickname');
            $table->string('open_id')->index();
            $table->string('union_id')->index();
            $table->string('language', 10);
            $table->string('gender', 10);
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
        \Schema::dropIfExists('wechat_users');
    }
}
