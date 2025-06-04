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
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('cascade');

            // Dados da solicitação
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('expected_budget', 10, 2)->nullable();
            $table->timestamp('desired_date')->nullable();
            $table->string('service_address')->nullable();
            $table->string('preferred_contact')->nullable();
            $table->enum('urgency', ['low', 'medium', 'high'])->default('medium');
            $table->json('additional_details')->nullable();

            $table->enum('status', [
                'open', 
                'in_negotiation', 
                'accepted', 
                'rejected', 
                'cancelled', 
                'expired'
            ])->default('open');

            $table->timestamp('request_date')->useCurrent();
            $table->timestamp('response_date')->nullable();
            $table->timestamp('expiration_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};
