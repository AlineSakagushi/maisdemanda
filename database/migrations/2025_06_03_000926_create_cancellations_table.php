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
        Schema::create('cancellations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_order_id')->constrained('service_orders')->onDelete('cascade');
            $table->foreignId('cancelled_by')->constrained('users');
            $table->enum('cancellation_type', ['client', 'professional', 'system', 'admin']);
            $table->enum('reason', ['change_of_plans', 'scheduling_problem', 'budget_dissatisfaction', 'found_another_option', 'emergency', 'other']);
            $table->text('reason_description')->nullable();
            $table->decimal('cancellation_fee', 10, 2)->default(0.00);
            $table->enum('refund_status', ['not_applicable', 'pending', 'processed', 'denied'])->default('not_applicable');
            $table->timestamp('cancelled_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cancellations');
    }
};