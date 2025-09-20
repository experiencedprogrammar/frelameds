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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('order_id')->unique();
        $table->string('name');
        $table->string('phone');
        $table->string('email')->nullable();
        $table->text('address');
        $table->decimal('subtotal', 10, 2);
        $table->decimal('shipping', 10, 2);
        $table->decimal('total', 10, 2);
        $table->json('items'); // store cart items as JSON
        $table->string('status')->default('pending'); // pending, paid, shipped, etc.
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
