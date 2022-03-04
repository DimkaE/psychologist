<?php

namespace Database\Factories;

use App\Models\Direction;
use App\Models\PsychologistDirection;
use App\Models\PsychologistPeriod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'second_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'birthdate' => $this->faker->dateTimeBetween('-60 years', '-20 years'),
            'role' => 2,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'published' => true,
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'about' => $this->faker->text(500),
            'email_verified_at' => now(),
            'experience' => rand(5,25),
            'password' => Hash::make('123123'), // password
            'remember_token' => Str::random(10),
            'skype' => Str::random(10),
            'discord' => Str::random(10),
            'hangouts' => Str::random(10),
        ];
    }

    public function configure()
    {
        $imgs = [
            url('images/sample/1.jpg'),
            url('images/sample/2.jpg'),
            url('images/sample/3.jpg'),
        ];
        return $this->afterMaking(function (User $user) {
            //
        })->afterCreating(function (User $user) use ($imgs){
            if ($user->role == 2) {
                $user->directionsRel()->save(
                    new PsychologistDirection([
                        'direction_id' => Direction::inRandomOrder()->first()->id
                    ]));
                $user->periodsRel()->save(
                    new PsychologistPeriod([
                        'type' => 'day',
                        'number' => rand(1, 7),
                    ])
                );
                $k = rand(7, 19);
                for ($i = $k; $i < $k + 3; $i++)
                    $user->periodsRel()->save(
                        new PsychologistPeriod([
                            'type' => 'time',
                            'number' => $i,
                        ])
                    );

                $user->addMediaFromUrl($imgs[array_rand($imgs)])
                    ->toMediaCollection('avatar');
            }
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
