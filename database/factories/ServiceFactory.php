<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'estimated_duration' => $this->faker->numberBetween(10, 120),
            'status' => 'active', // ou 'inactive'
            'category_id' => 1, // ou crie um factory para ServiceCategory e use factory()->create()->id
            // preencha os campos que seu model Service precisa
        ];
    }
}
