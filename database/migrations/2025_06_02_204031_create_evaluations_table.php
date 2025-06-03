<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_order_id')->constrained('service_orders')->onDelete('cascade');
            $table->foreignId('client_id')->constrained('users');
            $table->foreignId('professional_id')->constrained('users');
            $table->foreignId('service_id')->constrained('services');
            $table->decimal('rating', 2, 1);
            $table->text('comment')->nullable();
            $table->json('evaluation_criteria')->nullable();
            $table->timestamp('evaluation_date')->useCurrent();
            $table->text('professional_response')->nullable();
            $table->timestamp('response_date')->nullable();
            $table->enum('status', ['active', 'inactive', 'hidden'])->default('active');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE evaluations ADD CONSTRAINT check_rating CHECK (rating >= 0 AND rating <= 5)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};