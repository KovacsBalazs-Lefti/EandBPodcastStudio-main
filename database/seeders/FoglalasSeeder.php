<?php

namespace Database\Seeders;

use App\Models\Foglalas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoglalasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Foglalas::factory(3)->create();
    }
}
