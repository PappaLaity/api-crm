<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "barcode" => fake()->unique()->ean13(),
            "designation" => fake()->text(50),
            "price" => 1000,
            "ref_provider" => "REF_PROVIDER_" . fake()->text(5),
            "ref_company" => "REF_COMPANY_" . fake()->unique()->text(5),
            "provider_id" => 1,
            "company_id" => 2,
        ];
    }
}
