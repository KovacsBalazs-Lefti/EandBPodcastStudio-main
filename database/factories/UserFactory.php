<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static string $password;
    protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */



    public function definition(): array
    {
        $name = $this->faker->unique()->name();
        $email = strtolower(str_replace(' ', '.', $name)) . '@example.com';

        return [
            'nev' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'jelszo' => bcrypt('pistike48'),
            'telefonszam' => $this->faker->phoneNumber(),
            'szemelyi_szam' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'szuletesi_datum' => $this->faker->date('Y-m-d', '-18 years'),
            'ceg' => $this->faker->boolean(),
            'cegnev' => $this->faker->company(),
            'ceg_tipus' => $this->faker->randomElement(['Bt', 'Kft', 'Zrt']),
            'ado_szam' => $this->faker->numerify('########'),
            'bankszamlaszam' => $this->faker->iban('HU'),
            'orszag' => 'Magyarország',
            'iranyitoszam' => $this->faker->postcode(),
            'varos' => $this->faker->city(),
            'utca' => $this->faker->streetName(),
            'utca_jellege' => $this->faker->randomElement(['út', 'utca', 'köz', 'tér']),
            'hazszam' => $this->faker->buildingNumber(),
            'epulet' => $this->faker->randomLetter(),
            'lepcsohaz' => $this->faker->randomDigitNotNull(),
            'emelet' => $this->faker->randomDigitNotNull(),
            'ajto' => $this->faker->randomDigitNotNull(),
            'created_at' => now(),
            'updated_at' => now(),

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });

    }
}
