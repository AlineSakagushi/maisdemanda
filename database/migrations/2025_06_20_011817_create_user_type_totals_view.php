<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE VIEW user_type_totals AS
            SELECT
                SUM(CASE WHEN user_type = 'Client' THEN 1 ELSE 0 END) AS total_clients,
                SUM(CASE WHEN user_type = 'Professional' THEN 1 ELSE 0 END) AS total_professionals
            FROM users
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS user_type_totals");
    }
};
