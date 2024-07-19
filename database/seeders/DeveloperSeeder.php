<?php

namespace Database\Seeders;

use App\Models\Developer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $developers = [
            ['name' => 'DEV1', 'capacity' => 1],
            ['name' => 'DEV2', 'capacity' => 2],
            ['name' => 'DEV3', 'capacity' => 3],
            ['name' => 'DEV4', 'capacity' => 4],
            ['name' => 'DEV5', 'capacity' => 5],
        ];

        foreach ($developers as $developer) {
            Developer::create($developer);
        }
    }
}
