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

        $allfelhasznaloid = User::all()->pluck('felhasznaloid');
        $user_felhasznaloid = $this->faker->randomElement($allfelhasznaloid);

        $allszolgaltatas = Foglalas::all()->pluck('foglalasid');
        $foglalasid_szolgaltatasok = $this->faker->randomElement($allszolgaltatas);

        return [
            'szolgaltatasnev' => $this->faker->sentence(10),
            'leiras' => $this->faker->paragraph(),
            'ar'=> $this->faker->numberBetween(25000, 180000),
            'foglalasid_szolgaltatasok' => $foglalasid_szolgaltatasok,
            'user_felhasznaloid' => $user_felhasznaloid,
        ];
    }
}
