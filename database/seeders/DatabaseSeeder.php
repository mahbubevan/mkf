<?php

namespace Database\Seeders;

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
        DB::table('admins')->insert([
            'name' => 'admin',
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('admin'),
        ]);
    }
}
