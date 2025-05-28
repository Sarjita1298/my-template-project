<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up()
{
    Schema::create('reports', function (Blueprint $table) {
        $table->id();
        $table->string('order_id');           // varchar for order_id
        $table->decimal('total_price', 10, 2);
        $table->date('order_date');
        $table->string('order_status')->default('pending'); // or use ->default(0) if using numeric codes
        $table->string(column: 'shipping_status')->nullable(); // varchar, nullable if you want        $table->string('customer_name');
        $table->timestamps(true);
    });
}




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
