<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubDistrict;

class SubDistrictSeeder extends Seeder
{
    public function run(): void
    {
        SubDistrict::factory()->count(50)->create();
    }
}
