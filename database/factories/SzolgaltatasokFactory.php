<?php

namespace Database\Factories;

use App\Models\Szolgaltatasok;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Foglalas;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Szolgaltatasok>
 */
class SzolgaltatasokFactory extends Factory
{
    protected $model = Szolgaltatasok::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'szolgaltatasnev' => $this->faker->words(5,true),
            'leiras' => $this->faker->paragraph(),
            'ar'=> $this->faker->numberBetween(25000, 180000),
        ];
    }
}
