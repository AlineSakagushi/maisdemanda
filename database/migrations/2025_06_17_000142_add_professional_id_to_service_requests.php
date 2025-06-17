<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->foreignId('professional_id')->nullable()->constrained('users')->after('client_id');
        });
    }

    public function down(): void
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->dropForeign(['professional_id']);
            $table->dropColumn('professional_id');
        });
    }
};
