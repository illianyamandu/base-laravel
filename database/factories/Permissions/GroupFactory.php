<?php

namespace Database\Factories\Permissions;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();

        return [
            'name'        => $name,
            'slug'        => Str::slug($name, '-'),
            'description' => "This is the description for the $name group.",
        ];
    }
}
