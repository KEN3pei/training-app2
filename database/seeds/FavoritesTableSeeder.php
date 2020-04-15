<?php

use Illuminate\Database\Seeder;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('favorites')->insert([
            
            // ['id' => '4',
            // 'user_id' => '1',
            // 'training_id' => '3'
            // ],
            // [
            // 'id' => '5',
            // 'user_id' => '1',
            // 'training_id' => '4'
            // ],
            // [
            // 'id' => '6',
            // 'user_id' => '2',
            // 'training_id' => '3'
            // ],
            
        ]);
    }
}
