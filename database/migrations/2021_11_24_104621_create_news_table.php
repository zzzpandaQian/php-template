<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('')->comment('标题');
            $table->integer('news_category_id')->comment('新闻分类ID');
            $table->string('banner_url')->nullable()->comment('头图链接');
            $table->text('excerpt')->nullable()->comment('简介');
            $table->text('content')->nullable()->comment('内容');
            $table->integer('read_count')->default('0')->comment('阅读量');
            $table->tinyInteger('is_recommend')->default('0')->comment('是否推荐');
            $table->tinyInteger('status')->default('0')->comment('状态');
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
        Schema::dropIfExists('news');
    }
}
