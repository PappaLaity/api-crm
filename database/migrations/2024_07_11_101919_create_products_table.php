<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('ref_provider');// REF PROVIDER
            $table->foreignUuid('provider_id')->constrained('structures')->onDelete('cascade');// ID PROVIDER
            $table->string('ref_company')->unique()->nullable();// REF COMPANY
            $table->foreignUuid('company_id')->nullable()->constrained('structures')->onDelete('cascade');// ID COMPANY
            $table->string('designation');// DESIGNATION
            $table->string('barcode');// BarCode
            $table->decimal('price', 10, 2);;// Price
            // Add Quantity
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
