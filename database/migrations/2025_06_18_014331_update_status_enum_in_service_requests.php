<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Adiciona o novo status 'completed' ao ENUM da coluna 'status'
        DB::statement("ALTER TABLE service_requests MODIFY status ENUM(
            'open',
            'in_negotiation',
            'accepted',
            'rejected',
            'cancelled',
            'expired',
            'completed'
        ) DEFAULT 'open'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverte para os valores anteriores, removendo 'completed'
        DB::statement("ALTER TABLE service_requests MODIFY status ENUM(
            'open',
            'in_negotiation',
            'accepted',
            'rejected',
            'cancelled',
            'expired'
        ) DEFAULT 'open'");
    }
};
