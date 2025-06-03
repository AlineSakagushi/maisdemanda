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
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_payment_id')->constrained('service_payments')->onDelete('cascade');
            $table->foreignId('requested_by')->constrained('users');
            $table->decimal('requested_amount', 10, 2);
            $table->decimal('approved_amount', 10, 2)->nullable();
            $table->enum('reason', ['service_not_performed', 'dissatisfaction', 'cancellation', 'billing_error', 'other']);
            $table->text('reason_description')->nullable();
            $table->enum('status', ['requested', 'under_review', 'approved', 'denied', 'processed'])->default('requested');
            $table->timestamp('requested_at')->useCurrent();
            $table->timestamp('processed_at')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users');
            $table->text('review_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refunds');
    }
};
