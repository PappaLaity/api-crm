<?php

namespace Database\Seeders;

use App\Enums\StructureType;
use App\Enums\UserRole;
use App\Models\Structure;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Structure::factory()->create([
            "typeStructure" => StructureType::ADMIN->value,
        ]);
        Structure::factory()->create([
            "typeStructure" => StructureType::Provider->value,
        ]);

        User::factory()->create([
            'name' => 'User Admin',
            'email' => 'test@example.com',
            'role' => UserRole::ADMIN->value,
            "structure_id" => Structure::where('typeStructure', StructureType::ADMIN->value)->get()->random()->id
        ]);

    }
}
