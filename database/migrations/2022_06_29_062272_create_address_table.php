<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
            $table->string('detail', 50)->nullable()->comment('详细地址');
            $table->tinyInteger('is_default')->default(0)->comment('默认:0否,1是');
            $table->string('province')->comment('省')->index();
            $table->string('city')->comment('市')->index();
            $table->string('district')->comment('区')->index();
            $table->string('mobile')->comment('联系号码');
            $table->string('contact', 18)->comment('联系人');
            $table->foreignId('user_id')->nullable()->constrained('users');
            // $table->integer('user_id')->comment('关联用户');

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
        Schema::dropIfExists('address');
    }
}
