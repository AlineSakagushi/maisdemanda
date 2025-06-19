<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE VIEW dashboard_growth AS
                SELECT
                    IFNULL(SUM(CASE WHEN MONTH(payment_date) = MONTH(CURRENT_DATE()) AND YEAR(payment_date) = YEAR(CURRENT_DATE()) THEN total_amount END), 0) AS current_month,
                    IFNULL(SUM(CASE WHEN MONTH(payment_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(payment_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) THEN total_amount END), 0) AS last_month,
                    ROUND(
                        CASE
                            WHEN IFNULL(SUM(CASE WHEN MONTH(payment_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(payment_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) THEN total_amount END), 0) = 0
                                AND IFNULL(SUM(CASE WHEN MONTH(payment_date) = MONTH(CURRENT_DATE()) AND YEAR(payment_date) = YEAR(CURRENT_DATE()) THEN total_amount END), 0) > 0
                            THEN IFNULL(SUM(CASE WHEN MONTH(payment_date) = MONTH(CURRENT_DATE()) AND YEAR(payment_date) = YEAR(CURRENT_DATE()) THEN total_amount END), 0) * 100
                            WHEN IFNULL(SUM(CASE WHEN MONTH(payment_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(payment_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) THEN total_amount END), 0) > 0
                            THEN (
                                (
                                    IFNULL(SUM(CASE WHEN MONTH(payment_date) = MONTH(CURRENT_DATE()) AND YEAR(payment_date) = YEAR(CURRENT_DATE()) THEN total_amount END), 0)
                                    -
                                    IFNULL(SUM(CASE WHEN MONTH(payment_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(payment_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) THEN total_amount END), 0)
                                ) / IFNULL(SUM(CASE WHEN MONTH(payment_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(payment_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) THEN total_amount END), 0)
                            ) * 100
                            ELSE 0
                        END,
                    2) AS growth_percentage,
                    (SELECT SUM(available_balance) FROM users) AS total_available_balance
                FROM service_payments
                WHERE payment_status = 'approved';
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS dashboard_growth");
    }
};
