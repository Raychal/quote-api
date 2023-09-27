<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::create(['name' => 'Finance', 'status' => 1]);
        Type::create(['name' => 'Life', 'status' => 1]);
        Type::create(['name' => 'Learning', 'status' => 1]);
        Type::create(['name' => 'Leadrship', 'status' => 1]);
        Type::create(['name' => 'Imagination', 'status' => 1]);
        Type::create(['name' => 'Inspirational', 'status' => 1]);
        Type::create(['name' => 'Intelligence', 'status' => 1]);
        Type::create(['name' => 'Knowledge', 'status' => 1]);
        Type::create(['name' => 'Love', 'status' => 1]);
        Type::create(['name' => 'Dreams', 'status' => 1]);
        Type::create(['name' => 'Courage', 'status' => 1]);
        Type::create(['name' => 'Attitude', 'status' => 1]);
        Type::create(['name' => 'Architecture', 'status' => 1]);
        Type::create(['name' => 'Sigma', 'status' => 1]);
        Type::create(['name' => 'Alone', 'status' => 1]);
        Type::create(['name' => 'Communications', 'status' => 1]);
        Type::create(['name' => 'Experience', 'status' => 1]);
        Type::create(['name' => 'Failure', 'status' => 1]);
        Type::create(['name' => 'Faith', 'status' => 1]);
        Type::create(['name' => 'Family', 'status' => 1]);
        Type::create(['name' => 'Famous', 'status' => 1]);
        Type::create(['name' => 'Fear', 'status' => 1]);
        Type::create(['name' => 'Fitness', 'status' => 1]);
        Type::create(['name' => 'Forgiveness', 'status' => 1]);
        Type::create(['name' => 'Freedom', 'status' => 1]);
        Type::create(['name' => 'Friendship', 'status' => 1]);
        Type::create(['name' => 'Great', 'status' => 1]);
        Type::create(['name' => 'Health', 'status' => 1]);
        Type::create(['name' => 'Happiness', 'status' => 1]);
        Type::create(['name' => 'History', 'status' => 1]);
        Type::create(['name' => 'Home', 'status' => 1]);
        Type::create(['name' => 'Hope', 'status' => 1]);
    }
}
