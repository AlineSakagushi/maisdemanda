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
        Schema::create('contract_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('content');
            $table->enum('type', ['general_service', 'specific_category', 'custom'])->default('general_service');
            $table->foreignId('service_category_id')->nullable()->constrained('service_categories');
            $table->boolean('active')->default(true);
            $table->string('version', 10)->default('1.0');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_templates');
    }
};
