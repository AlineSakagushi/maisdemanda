<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Remova os campos que não são mais necessários
            if (Schema::hasColumn('services', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('services', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('services', 'duration')) {
                $table->dropColumn('duration');
            }
            if (Schema::hasColumn('services', 'details')) {
                $table->dropColumn('details');
            }
            if (Schema::hasColumn('services', 'location')) {
                $table->dropColumn('location');
            }
            if (Schema::hasColumn('services', 'available_from')) {
                $table->dropColumn('available_from');
            }
            if (Schema::hasColumn('services', 'available_to')) {
                $table->dropColumn('available_to');
            }
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Caso queira voltar atrás
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('duration')->nullable();
            $table->json('details')->nullable();
            $table->string('location')->nullable();
            $table->date('available_from')->nullable();
            $table->date('available_to')->nullable();
        });
    }
};
