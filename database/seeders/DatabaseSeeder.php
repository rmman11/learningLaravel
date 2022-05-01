<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

      $faker = \Faker\Factory::create();
   for ($i=0; $i < 5; $i++) {
      DB::table('admin_users')->insert([
         'username' => $faker->word,
         'email' => $faker->unique()->email,
        'remember_token' => str::random(50),
         'avatar' =>$faker->image('public/uploads',640,480, null, false),
         'password' => bcrypt('secret123'),
         'created_at' => date('Y-m-d H:i:s'),
         'updated_at' => date('Y-m-d H:i:s'),
     ]);
       }
    }
}
