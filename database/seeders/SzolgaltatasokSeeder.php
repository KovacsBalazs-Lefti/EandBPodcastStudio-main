<?php

namespace Database\Seeders;

use App\Models\Szolgaltatasok;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SzolgaltatasokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Szolgaltatasok::factory(3)->create();
    }
}
