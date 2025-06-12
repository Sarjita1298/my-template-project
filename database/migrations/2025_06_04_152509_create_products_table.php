<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('product_name');
            $table->decimal('discount_percentage', 5, 2)->default(0);
            $table->text('product_short_description');
            $table->longText('product_long_description');
            $table->decimal('product_price', 10, 2);
            $table->decimal('product_review_star', 2, 1)->default(0); // Optional default
            $table->unsignedTinyInteger('rating')->default(0); // new column for rating (0-5)
            $table->unsignedBigInteger('popularity')->default(0); // new column for sorting/popularity
            $table->string('product_image')->nullable();
            $table->timestamps(true);
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
