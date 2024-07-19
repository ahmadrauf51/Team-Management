<?php

namespace App\Services;

interface TaskProviderInterface
{
    public function fetchTasks(): array;
}
