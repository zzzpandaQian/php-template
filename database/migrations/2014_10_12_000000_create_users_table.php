<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile', 20)->comment('手机(帐号)')->nullable()->index();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('gender')->unsigned()->default(0)->comment('性别 0：保密 1：男，2：女')->index();
            $table->date('birthdate')->comment('出生日期')->nullable();
            $table->string('avatar')->comment('自定义头像')->nullable();
            $table->string('address')->comment('地址')->nullable();
            $table->string('wx_nickname', 80)->comment('微信昵称')->nullable();
            $table->string('wx_avatar')->comment('微信头像')->nullable();
            $table->string('wx_openid', 80)->comment('公众号openid')->nullable();
            $table->string('xcx_openid')->comment('小程序openid')->nullable();
            $table->string('unionid')->comment('unionid')->nullable();
            $table->string('oauth_scope')->comment('微信授权方式 1：静默授权，2：用户信息授权')->nullable();
            $table->tinyInteger('status')->comment('帐号状态')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
