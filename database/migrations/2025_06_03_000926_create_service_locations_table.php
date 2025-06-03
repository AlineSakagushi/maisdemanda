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
        Schema::create('service_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('professional_id')->constrained('users')->onDelete('cascade');
            $table->string('name', 100); // Ex: "Central Office", "Home Service"
            $table->enum('type', ['fixed', 'home_service', 'online', 'hybrid'])->default('fixed');
            $table->string('address', 255)->nullable();
            $table->string('city', 100);
            $table->string('state', 50);
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->decimal('service_radius', 8, 2)->nullable(); // in KM
            $table->text('observations')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_locations');
    }
};