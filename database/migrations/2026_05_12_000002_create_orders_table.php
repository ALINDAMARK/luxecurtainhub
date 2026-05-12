<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 120);
            $table->string('email', 120);
            $table->string('phone', 30);
            $table->string('product_name', 160);
            $table->unsignedInteger('quantity')->default(1);
            $table->string('delivery_address', 255);
            $table->text('notes')->nullable();
            $table->string('status', 40)->default('new');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
