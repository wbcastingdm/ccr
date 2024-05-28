<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            '1000' => 'کارت برنزی',
            '2000' => 'کارت نقره ای',
            '3000' => 'کارت طلایی',
        ];

        foreach ($levels as $limit => $name) {
            Level::create([
                'name' => $name,
                'required_points' => $limit
            ]);
        }
    }
}
