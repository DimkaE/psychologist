<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => '447934@mail.ru',
            'name' => 'Admin',
            'phone' => '123456',
            'password' => Hash::make('uZdhex27'),
            'role' => 100
        ]);

        User::create([
            'email' => 'admin@helpi.ru',
            'name' => 'Admin',
            'phone' => '1234567',
            'password' => Hash::make('81VvZEot1J'),
            'role' => 100
        ]);

        User::factory()
            ->times(30)
            ->create();
    }
}
