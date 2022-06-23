<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('')->comment('标题');
            $table->string('seo_title')->comment('seo标题')->nullable();
            $table->string('seo_keywords')->comment('seo关键字')->nullable();
            $table->text('seo_description')->comment('seo描述')->nullable();
            $table->integer('parent_id')->comment('父级')->nullable();
            $table->integer('sort_order')->comment('排序');
            $table->string('permalink')->comment('链接');
            $table->text('content')->comment('内容');
            $table->tinyInteger('status')->comment('状态');
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
        Schema::dropIfExists('pages');
    }
}
