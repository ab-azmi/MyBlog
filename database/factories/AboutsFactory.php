<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AboutsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return
        [
            'first_text' => $this->faker->paragraph(),
            'second_text' => $this->faker->paragraph(),
            'first_image' => 'setting/about-img-1.jpg',
            'second_image' => 'setting/about-img-2.jpg',
            'our_mission' => $this->faker->paragraph(),
            'our_vision' => $this->faker->paragraph(),
            'services' => $this->faker->paragraph(),
        ];
    }
}
