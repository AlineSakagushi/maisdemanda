<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("
            DROP PROCEDURE IF EXISTS create_service_payment;
            CREATE PROCEDURE create_service_payment (
                IN p_service_order_id BIGINT,
                IN p_client_id BIGINT,
                IN p_professional_id BIGINT,
                IN p_service_amount DECIMAL(10,2),
                IN p_payment_method VARCHAR(50), 
                IN p_platform_fee DECIMAL(10,2),
                IN p_transaction_code VARCHAR(255),
                IN p_payment_data JSON
            )
            BEGIN
                DECLARE v_total_amount DECIMAL(10,2);
                SET v_total_amount = p_service_amount + p_platform_fee;

                INSERT INTO service_payments (
                    service_order_id,
                    client_id,
                    professional_id,
                    total_amount,
                    service_amount,
                    platform_fee,
                    payment_method,
                    payment_status,
                    payment_date,
                    due_date,
                    transaction_code,
                    payment_data,
                    created_at,
                    updated_at
                ) VALUES (
                    p_service_order_id,
                    p_client_id,
                    p_professional_id,
                    v_total_amount,
                    p_service_amount,
                    p_platform_fee,
                    p_payment_method,
                    'approved',
                    NOW(),
                    NULL,
                    p_transaction_code,
                    p_payment_data,
                    NOW(),
                    NOW()
                );
            END;
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS create_service_payment;");
    }
};
