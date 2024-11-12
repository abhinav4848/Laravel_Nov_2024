<?php

namespace App\Models;

use Illuminate\Support\Arr;

class Job
{
    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Director',
                'salary' => '$50000'
            ],
            [
                'id' => 2,
                'title' => 'Programmer',
                'salary' => '$10000'
            ],
            [
                'id' => 3,
                'title' => 'Teacher',
                'salary' => '$40000'
            ]
        ];
    }

    public static function find(int $id): array
    {
        //can also say Job:all() instead of static:all() but we're already in job class
        $job = Arr::first(static::all(), fn ($job) => $job['id'] == $id);

        if (!$job) {
            // if we don't do this, this script would return null if no such job was found for the id.
            abort(404);
        }

        return $job;

    }
}
