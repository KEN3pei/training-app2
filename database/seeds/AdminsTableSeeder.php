<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            
                ['id' => 1,
                'name' => "admintest1",
                'email' => "admintest1@sample.com",
                'password' => Hash::make('adminadmin'),
                'remember_token' => str_random(10),
                ]
            
            ]);
    }
}
