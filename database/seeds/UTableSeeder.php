<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
\DB::table('users')->insert([
            'username' => 'クラピカ',
            'mail' => 'hxh13@gmail.com',
            'password' => Hash::make("password"),
        ]
    );
    }
}
