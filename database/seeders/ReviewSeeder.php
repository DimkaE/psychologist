<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Review::factory()
            ->times(10)
            ->create();
    }
}
