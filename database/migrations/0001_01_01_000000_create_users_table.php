<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->enum('user_type', ['Client', 'Professional', 'Admin'])->default('Client');
            $table->text('description')->nullable();

            $table->decimal('rating_average', 5, 2)->default(0);
            $table->unsignedInteger('total_ratings')->default(0);

            $table->string('profile_photo')->nullable();
            $table->string('document')->nullable(); // CPF or other
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();

            $table->enum('status', ['Active', 'Inactive', 'Pending'])->default('Active');
            $table->decimal('available_balance', 10, 2)->default(0);
            $table->boolean('available_for_work')->default(false);

            $table->json('working_hours')->nullable();
            $table->decimal('hourly_rate', 10, 2)->nullable();

            $table->string('city')->nullable();
            $table->string('state')->nullable();

            $table->string('specialization')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
