<?php

namespace Database\Seeders;

use App\Enums\StructureType;
use App\Enums\UserRole;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use App\Models\Stock;
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
            'email' => 'admin@example.com',
            'role' => UserRole::ADMIN->value,
            "structure_id" => Structure::where('typeStructure', StructureType::ADMIN->value)->get()->random()->id
        ]);

        User::factory()->create([
            'name' => 'User Manager',
            'email' => 'manager@example.com',
            'role' => UserRole::MANAGER->value,
            "structure_id" => Structure::where('typeStructure', StructureType::ADMIN->value)->get()->random()->id
        ]);

        Customer::factory(2)->create();

        Product::factory(5)->create([
            "provider_id" => Structure::where('typeStructure', StructureType::Provider->value)->get()->random()->id,
            "company_id" => Structure::where('typeStructure', StructureType::ADMIN->value)->get()->random()->id,
        ]);
        Product::factory(2)->create([
            "provider_id" => Structure::where('typeStructure', StructureType::Provider->value)->get()->random()->id,
            "company_id" => null,
        ]);

        Order::factory(2)->create([
            "user_id" => User::where('role', UserRole::MANAGER->value)->get()->random()->id
        ]);

        OrderLine::factory(2)->create([
            "order_id" => Order::all()->random()->id,
            "product_id" => Product::where('company_id', '<>', null)->get()->random()->value('id'),
        ]);

        Stock::factory(2)->create([
            "product_company_id" => Structure::where('typeStructure', StructureType::ADMIN->value)->get()->random()->id,
        ]);

    }
}
