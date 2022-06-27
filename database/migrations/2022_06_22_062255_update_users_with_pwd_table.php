<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersWithPwdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_with_pwd', function (Blueprint $table) {
            $table->text('avatar')->comment('头像')->nullable();
            $table->string('nickname', 18)->nullable()->default('用户'.time())->change();
            $table->rememberToken();
            // $table->tinyInteger('user_id', 3)->change();
            $table->date('birth')->comment('生日')->nullable();
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
