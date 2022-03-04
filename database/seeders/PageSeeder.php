<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'meta_title' => 'Главная',
            'meta_description' => 'Главная',
            'url' => '/'
        ]);
        Page::create([
            'meta_title' => 'Работа психологу',
            'meta_description' => 'Работа психологу',
            'url' => '/work',
        ]);
        Page::create([
            'meta_title' => 'Блог',
            'meta_description' => 'Блог',
            'url' => '/blog',
        ]);
    }
}
