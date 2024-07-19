<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::insert([
            ['name' => 'Task 1', 'duration' => 10, 'difficulty' => 2],
            ['name' => 'Task 2', 'duration' => 20, 'difficulty' => 3],
            ['name' => 'Task 3', 'duration' => 5, 'difficulty' => 1],
            ['name' => 'Task 4', 'duration' => 15, 'difficulty' => 4],
            ['name' => 'Task 5', 'duration' => 25, 'difficulty' => 5],
        ]);
    }
}
