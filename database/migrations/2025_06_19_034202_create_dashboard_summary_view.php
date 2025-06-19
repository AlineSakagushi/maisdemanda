<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateDashboardSummaryView extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE VIEW dashboard_summary AS
            SELECT
                (SELECT COUNT(*) FROM users) AS total_users,
                (SELECT COUNT(*) FROM users WHERE user_type = 'Client') AS total_clients,
                (SELECT COUNT(*) FROM users WHERE user_type = 'Professional') AS total_professionals,
                (SELECT COUNT(*) FROM service_requests) AS total_service_requests
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS dashboard_summary");
    }
}
