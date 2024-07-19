<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Services\MockTaskProvider1;
use App\Services\MockTaskProvider2;
use App\Services\TaskAllocator;
use Illuminate\Console\Command;

class FetchTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch tasks from mock APIs and save to the database';


    protected $providers;
    protected $allocator;

    public function __construct(MockTaskProvider1 $provider1, MockTaskProvider2 $provider2, TaskAllocator $allocator)
    {
        parent::__construct();
        $this->providers = [$provider1, $provider2];
        $this->allocator = $allocator;
    }



    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach ($this->providers as $provider) {
            $tasks = $provider->fetchTasks();
            foreach ($tasks as $task) {
                Task::create([
                    'name' => $task['name'],
                    'duration' => $task['duration'],
                    'difficulty' => $task['difficulty'],
                ]);
            }
        }

        $this->allocator->allocateTasks();

        $this->info('Tasks fetched and saved successfully.');
    }
}
