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
        Schema::create('service_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_order_id')->constrained('service_orders')->onDelete('cascade');
            $table->foreignId('client_id')->constrained('users');
            $table->foreignId('professional_id')->constrained('users');
            $table->decimal('total_amount', 10, 2);
            $table->decimal('service_amount', 10, 2);
            $table->decimal('platform_fee', 10, 2)->default(0.00);
            $table->enum('payment_method', ['credit_card', 'pix', 'bank_slip', 'digital_wallet']);
            $table->enum('payment_status', ['pending', 'approved', 'declined', 'cancelled', 'refunded'])->default('pending');
            $table->timestamp('payment_date')->nullable();
            $table->timestamp('due_date')->nullable();
            $table->string('transaction_code')->nullable();
            $table->json('payment_data')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_payments');
    }
};