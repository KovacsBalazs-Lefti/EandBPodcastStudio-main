<?php

namespace Database\Factories;

use App\Models\Foglalas;
use App\Models\Szolgaltatasok;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Foglalas>
 */
class FoglalasFactory extends Factory
{

    protected $model = Foglalas::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
            $allfelhasznaloid = User::all()->pluck('felhasznaloid');
            $user_felhasznaloid = $this->faker->randomElement($allfelhasznaloid);

            $allSzolgaltatasok = Szolgaltatasok::all()->pluck('szolgaltatasnev');
            $szolgaltatasnev = $this->faker->randomElement($allSzolgaltatasok);


            return [
                'user_felhasznaloid' => $user_felhasznaloid,
                'szolgaltatasnev' => $szolgaltatasnev,
                'letszam' => rand(1, 5),
                'foglalaskezdete' => Carbon::now()->addDays(rand(1, 365)), // Add 1 to 365 days to current date
                'foglalashossza' => rand(1, 7),
                'megjegyzes' => $this->faker->paragraph(2), // Generate 2 paragraphs
            ];
    }
}
