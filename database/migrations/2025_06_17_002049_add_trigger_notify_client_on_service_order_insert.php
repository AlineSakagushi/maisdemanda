<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER after_service_order_insert
            AFTER INSERT ON service_orders
            FOR EACH ROW
            BEGIN
                DECLARE v_client_id BIGINT;

                -- Pega o client_id da solicitação vinculada
                SELECT client_id
                INTO v_client_id
                FROM service_requests
                WHERE id = NEW.service_request_id;

                -- Insere notificação para o cliente
                INSERT INTO notifications (
                    user_id,
                    title,
                    message,
                    type,
                    `read`,
                    created_at,
                    updated_at
                ) VALUES (
                    v_client_id,
                    "Sua solicitação foi aceita!",
                    CONCAT("Um profissional aceitou sua solicitação (ID: ", NEW.service_request_id, ")."),
                    "info",
                    false,
                    NOW(),
                    NOW()
                );
            END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_service_order_insert');
    }
};

