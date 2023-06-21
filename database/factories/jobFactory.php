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
            'title' => $this->faker->jobTitle(),
            'location' => $this->faker->country(),
            'companyName' => $this->faker->company(),
            'companyEmail' => $this->faker->unique()->email(),
            'jobDescription' => $this->faker->text(),
            'employmentType' => 'full-time',
            'salary' => $this->faker->randomNumber(5),
            'companyLogo' => $this->faker->imageUrl(300, 300, 'company'),
            'tags' => 'laravel, python, MVC'
        ];
    }
}
