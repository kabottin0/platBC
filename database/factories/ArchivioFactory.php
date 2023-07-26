<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Archivio>
 */
class ArchivioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        
        return [
            'label' => $this->faker->text(15),
            'type'  => $this->faker->randomElement($array = array('Text','Selezione multipla','booleano')),
            'value' => $this->faker->text(15),
            
        ];
    }
}
