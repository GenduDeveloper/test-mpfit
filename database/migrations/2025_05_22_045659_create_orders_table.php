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
            $table->string('customer_name');
            $table->string('customer_surname');
            $table->string('customer_patronymic');
            $table->timestamp('created_at');
            $table->string('status', 100)->default('новый');
            $table->tinyText('comment')->nullable();

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->integer('product_quantity');
            $table->decimal('total_price');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
