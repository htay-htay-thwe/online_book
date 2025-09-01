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
        Schema::create('real_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('bookName');
            $table->string('price');
            $table->string('bookImage');
            $table->string('selected')->default('false')->nullable();
            $table->string('user_id');
            $table->string('orderId');
            $table->string('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_orders');
    }
};
