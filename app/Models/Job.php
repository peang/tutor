<?php

namespace App\Models;

use Arr;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
  public static function list(): array
  {
    return [
      [
        'id' => 1,
        'title' => 'Director',
        'salary' => '$50.000'
      ],
      [
        'id' => 2,
        'title' => 'Programmer',
        'salary' => '$10.000'
      ],
      [
        'id' => 3,
        'title' => 'Teacher',
        'salary' => '$40.000'
      ],
    ];
  }

  public static function find($id): array
  {
    $job = Arr::first(Job::list(), fn($job) => $job['id'] == $id);

    if (!$job) {
      abort(404);
    }

    return $job;
  }
}