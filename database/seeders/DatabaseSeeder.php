<?php

namespace Database\Seeders;

use App\Models\Gift;
use App\Models\Level;
use App\Models\Point;
use App\Models\User;
use App\Models\UserType;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // clear all tables
        User::truncate();
        Point::truncate();
        Level::truncate();
        UserType::truncate();
        Gift::truncate();

        // call seeders
        $this->call(UsersTableSeeder::class);
        $this->call(LevelsTableSeeder::class);
    }
}
