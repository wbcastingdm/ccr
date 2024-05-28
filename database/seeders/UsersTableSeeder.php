<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create user types
        $types = [
            'عادی',
            'عمده'
        ];

        foreach ($types as $type) {
            UserType::create([
                'name' => $type
            ]);
        }

        // create users
        User::factory()->create([
            'name' => 'Hossein',
            'email' => 'ahoseinmasumpoora@gmail.com',
        ]);

        User::factory(10)->create();
    }
}
