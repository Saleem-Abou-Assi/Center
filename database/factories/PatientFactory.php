<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    protected $model = Patient::class; 
    
    public function definition() 
    { 
        return [ 'name' => $this->faker->name,
         'phone' => $this->faker->phoneNumber,
          'address' => $this->faker->address,
           'gender' => $this->faker->randomElement(['male', 'female']),
            'age' => $this->faker->numberBetween(1, 90),
         // Adjust the range as needed 
         ]; }
}
