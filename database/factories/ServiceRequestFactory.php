<?php

namespace Database\Factories;

use App\Models\ServiceRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceRequestFactory extends Factory
{
    protected $model = ServiceRequest::class;

    public function definition()
    {
        return [
            'client_id' => 1,  // ajuste conforme seu cenário
            'service_id' => 1, // ajuste conforme seu cenário
            'status' => 'open',
            'expiration_date' => now()->addDays(5),
            'expected_budget' => $this->faker->randomFloat(2, 100, 1000),
            'desired_date' => now()->addDays(7),
            'additional_details' => [],
        ];
    }
}
