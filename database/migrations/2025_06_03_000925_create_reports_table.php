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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reporter_id')->constrained('users');
            $table->foreignId('reported_id')->constrained('users');
            $table->foreignId('service_order_id')->nullable()->constrained('service_orders');
            $table->enum('type', ['inappropriate_behavior', 'service_not_performed', 'improper_billing', 'spam', 'inappropriate_content', 'other']);
            $table->text('description');
            $table->json('evidence')->nullable(); // URLs of images/documents
            $table->enum('status', ['open', 'under_review', 'resolved', 'rejected'])->default('open');
            $table->foreignId('reviewed_by')->nullable()->constrained('users');
            $table->text('resolution')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
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
