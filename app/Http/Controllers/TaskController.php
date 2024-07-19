<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\Task;
use App\Services\TaskAllocator;

class TaskController extends Controller
{
    public $allocator;

    public function __construct(TaskAllocator $allocator)
    {
        $this->allocator = $allocator;
    }


    public function index()
    {

        $this->allocator->allocateTasks();

        $tasks = Task::with('developers')->get();
        $developers = Developer::all();

        return view('tasks.index', compact('tasks', 'developers'));
    }
}
