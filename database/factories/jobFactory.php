<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class jobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'userId' => 1,
            'title' => $this->faker->title(),
            'location' => 'united states',
            'companyName' => $this->faker->name(),
            'companyEmail' => $this->faker->unique()->email(),
            'employmentType' => 'full time',
            'salary' => $this->faker->randomNumber(5),
            'companyLogoImagePath' => '/images/apple-logo.png',
            'tags' => 'laravel, python, MVC'
        ];
    }
}
