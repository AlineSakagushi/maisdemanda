<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("
            DROP PROCEDURE IF EXISTS create_service_order_after_accept;

            CREATE PROCEDURE create_service_order_after_accept(
                IN p_service_request_id BIGINT,
                IN p_final_amount DECIMAL(10,2)
            )
            BEGIN
                DECLARE v_professional_id BIGINT;

                SELECT professional_id
                INTO v_professional_id
                FROM service_requests
                WHERE id = p_service_request_id
                LIMIT 1;

                INSERT INTO service_orders (
                    service_request_id,
                    professional_id,
                    created_at_custom,
                    status,
                    final_amount,
                    created_at,
                    updated_at
                ) VALUES (
                    p_service_request_id,
                    v_professional_id,
                    NOW(),
                    'in_progress',
                    p_final_amount,
                    NOW(),
                    NOW()
                );
            END;
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS create_service_order_after_accept");
    }
};
