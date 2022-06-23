<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Column::factory(4)->create()->each(function ($column) {
            //create 5 cards for each column, except for the last one
            if ($column->id <= 3) {
                \App\Models\Card::factory(1)->create(['column_id'=>$column->id]);
            }
        });
    }
}
