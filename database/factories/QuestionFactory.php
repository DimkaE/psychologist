<?php

namespace Database\Factories;

use App\Models\Direction;
use App\Models\PsychologistDirection;
use App\Models\PsychologistPeriod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question' => $this->faker->text(150),
            'answer' => $this->faker->text(1000),
            'type' => rand(1,2),
        ];
    }

}
