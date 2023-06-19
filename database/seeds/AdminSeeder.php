<?php

use App\Admin;
use Illuminate\Database\Seeder;
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
        Admin::create([
            'name' => 'Sumon Ahmed',
            'email' => 'bdsumon4u@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
