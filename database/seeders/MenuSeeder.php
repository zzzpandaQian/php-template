<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_menu')->insert([
            [
                'parent_id'  => 0,
                'order'      => 3,
                'title'      => '新闻列表',
                'icon'       => 'fa-newspaper-o',
                'uri'        => '/news',
                'extension'  => '',
                'show'       => 1,
                'created_at' => Carbon::now()
            ],
            [
                'parent_id'  => 0,
                'order'      => 4,
                'title'      => '新闻分类',
                'icon'       => 'fa-align-justify',
                'uri'        => '/news-categories',
                'extension'  => '',
                'show'       => 1,
                'created_at' => Carbon::now()
            ],
            [
                'parent_id'  => 0,
                'order'      => 5,
                'title'      => '新闻标签',
                'icon'       => 'fa-tags',
                'uri'        => '/news-tags',
                'extension'  => '',
                'show'       => 1,
                'created_at' => Carbon::now()
            ],
            [
                'parent_id'  => 0,
                'order'      => 2,
                'title'      => '用户管理',
                'icon'       => 'fa-user',
                'uri'        => '/users',
                'extension'  => '',
                'show'       => 1,
                'created_at' => Carbon::now()
            ],
            [
                'parent_id'  => 0,
                'order'      => 6,
                'title'      => '滑块管理',
                'icon'       => 'fa-picture-o',
                'uri'        => '/sliders',
                'extension'  => '',
                'show'       => 1,
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
