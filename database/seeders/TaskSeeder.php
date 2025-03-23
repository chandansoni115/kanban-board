<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TasksSeeder extends Seeder
{
    public function run()
    {
        Task::factory()->count(10)->create();
    }
}
