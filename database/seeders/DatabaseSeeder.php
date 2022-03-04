<?php

namespace Database\Seeders;

use App\Models\PsychologistDirection;
use App\Models\User;
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
        $this->call([
            PageSeeder::class,
            DirectionSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            QuestionSeeder::class,
            ReviewSeeder::class,
            ArticleSeeder::class,
        ]);


    }
}
