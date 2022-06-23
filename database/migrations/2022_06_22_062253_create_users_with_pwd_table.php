<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersWithPwdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_with_pwd', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 12)->comment('账号')->unique();
            $table->string('password', 32)->comment('密码');
            $table->tinyInteger('gender')->default(0)->comment('性别:0男，1女');
            $table->string('nickname', 20)->default('用户名'.time())->index();
            $table->string('email', 20)->nullable();
            $table->string('mobile', 11)->unique()->nullable();
            $table->foreignId('user_id')->unique()->nullable()->constrained('users');

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
        Schema::dropIfExists('users_with_pwd');
    }
}
