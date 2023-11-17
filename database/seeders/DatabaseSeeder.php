<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Permissions\Group;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        User::factory()->create([
            'email'    => 'illianyamandu@gmail.com',
            'password' => 'D26m04a03',
        ]);

        Group::factory(10)->create();
    }
}
