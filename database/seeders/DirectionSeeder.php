<?php

namespace Database\Seeders;

use App\Models\Direction;
use Illuminate\Database\Seeder;

class DirectionSeeder extends Seeder
{
    public function run()
    {
        Direction::create([
            'name' => 'Трудности в отношениях'
        ]);
        Direction::create([
            'name' => 'Неуверенность в себе'
        ]);
        Direction::create([
            'name' => 'Проблемы со сном'
        ]);
        Direction::create([
            'name' => 'Сексуальные отношения'
        ]);
        Direction::create([
            'name' => 'Нежелательная агрессия'
        ]);

    }
}
