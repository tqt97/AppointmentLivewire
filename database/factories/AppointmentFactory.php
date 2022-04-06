<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => $this->faker->numberBetween(1, Client::count()),
            'date'=> $this->faker->date(),
            'time'=> $this->faker->time(),
            'note'=> $this->faker->sentence,
            'status'=> $this->faker->randomElement(['SCHEDULED','CLOSED']),
            'order_position'=> $this->faker->numberBetween(1,10),
        ];
    }
}
