<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            [
                'name' => '为',
                'description' => '为所欲为',
            ],
            [
                'name' => '爱',
                'description' => '爱恨交加',
            ],
            [
                'name' => '故',
                'description' => '故人相见',
            ],
            [
                'name' => '掌',
                'description' => '掌声雷动',
            ],
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->truncate();
    }
}
