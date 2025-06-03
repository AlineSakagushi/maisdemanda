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
        Schema::create('access_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('ip_address', 45);
            $table->string('user_agent', 500)->nullable();
            $table->string('action', 100); // login, logout, view_profile, etc
            $table->string('resource', 100)->nullable(); // which page/endpoint accessed
            $table->enum('result', ['success', 'failure', 'denied']);
            $table->text('details')->nullable();
            $table->timestamp('accessed_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_logs');
    }
};