<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Guessr;

class GuessrSeeder extends Seeder
{
    public function run(): void
    {
        Guessr::factory()->count(50)->create();
    }
}
