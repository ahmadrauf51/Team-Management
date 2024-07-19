<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MockTaskProvider1 implements TaskProviderInterface
{
    protected $url = 'https://github.com/WEG-Technology/mock.git/provider1';

    public function fetchTasks(): array
    {
        try {
            $response = Http::get($this->url);

            // Check for a successful response
            if ($response->successful()) {
                $tasks = $response->json(); // Convert response to array
                return is_array($tasks) ? $tasks : [];
            } else {
                // Handle API errors
                return [];
            }
        } catch (\Exception $e) {
            // Handle request errors
            Log::error('Error fetching tasks: ' . $e->getMessage());
            return [];
        }
    }
}
