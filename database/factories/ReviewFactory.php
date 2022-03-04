<?php

namespace Database\Factories;

use App\Models\Direction;
use App\Models\PsychologistDirection;
use App\Models\PsychologistPeriod;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(40),
            'description' => $this->faker->text(40),
            'text' => $this->faker->text(1000),
            'sort_order' => $this->faker->numberBetween(1, 1000),
            'type' => rand(1, 2),
        ];
    }

    public function configure()
    {
        $imgs = [
            url('images/sample/1.jpg'),
            url('images/sample/2.jpg'),
            url('images/sample/3.jpg'),
        ];
        return $this->afterMaking(function (Review $review) {
            //
        })->afterCreating(function (Review $review) use ($imgs) {
            $review->addMediaFromUrl($imgs[array_rand($imgs)])
                ->toMediaCollection('image');

        });
    }
}
