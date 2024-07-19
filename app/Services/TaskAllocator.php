<?php

namespace App\Services;

use App\Models\Developer;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TaskAllocator
{
     public function allocateTasks()
    {
        $tasks = Task::all();
        $developers = Developer::orderBy('capacity', 'desc')->get();
        $weeks = 0;

        DB::beginTransaction();

        try {
            while ($tasks->isNotEmpty()) {
                $weeks++;
                foreach ($tasks as $task) {
                    $remainingDuration = $task->duration;
                    $taskDifficulty = $task->difficulty; // Assuming difficulty translates directly to work units

                    foreach ($developers as $developer) {
                        $hoursAvailable = 45; // Weekly hours
                        $developerCapacity = $developer->capacity;
                        $workCapacity = $developerCapacity * $hoursAvailable; // Total work capacity for the week

                        if ($workCapacity >= $remainingDuration * $taskDifficulty) {
                            // Allocate entire task to this developer
                            $task->developers()->attach($developer->id, ['hours' => $remainingDuration, 'week' => $weeks]);
                            $remainingDuration = 0;
                            break;
                        } else {
                            // Allocate partial task to this developer
                            $allocatedHours = $workCapacity / $taskDifficulty;
                            $task->developers()->attach($developer->id, ['hours' => $allocatedHours, 'week' => $weeks]);
                            $remainingDuration -= $allocatedHours;
                        }
                    }

                    // If task is not fully allocated, keep it for the next week
                    if ($remainingDuration > 0) {
                        // Update task duration and keep it in the list
                        $task->duration = $remainingDuration;
                    } else {
                        // Task is completed
                        $tasks = $tasks->filter(function ($t) use ($task) {
                            return $t->id !== $task->id;
                        });
                    }
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Task allocation failed: ' . $e->getMessage());
        }
    }
}
