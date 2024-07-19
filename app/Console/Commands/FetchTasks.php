<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Services\MockTaskProvider1;
use App\Services\MockTaskProvider2;
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

    public function __construct(MockTaskProvider1 $provider1, MockTaskProvider2 $provider2)
    {
        parent::__construct();
        $this->providers = [$provider1, $provider2];
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting fetching');
        foreach ($this->providers as $provider) {
            $this->info('Getting Providers');
            $tasks = $provider->fetchTasks();
            $this->info('Tasks fetched');
            foreach ($tasks as $task) {
                $this->info('Creating Tasks');
                Task::create([
                    'name' => $task['name'],
                    'duration' => $task['duration'],
                    'difficulty' => $task['difficulty'],
                ]);
                $this->info('Created Task');
            }
        }
        $this->info('Tasks fetched and saved successfully.');
    }
}
