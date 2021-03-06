<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Super ",
            'surname' => "Admin",
            'role'=> 'admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('admin1998'),
           // 'file' =>  string('admin1998'),
        ]);

    }
}
