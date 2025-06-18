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
                DECLARE v_professional_name VARCHAR(255);
                DECLARE v_service_title VARCHAR(255);

                -- Pega o client_id da solicitação
                SELECT client_id
                INTO v_client_id
                FROM service_requests
                WHERE id = NEW.service_request_id;

                -- Pega o nome do profissional
                SELECT name
                INTO v_professional_name
                FROM users
                WHERE id = NEW.professional_id;

                -- Pega o título do serviço
                SELECT sr.title
                INTO v_service_title
                FROM services s
                INNER JOIN service_requests sr ON sr.service_id = s.id
                WHERE sr.id = NEW.service_request_id;

                -- Insere a notificação para o cliente
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
                    CONCAT(v_professional_name, " aceitou sua solicitação para o serviço: ", v_service_title, "."),
                    "info",
                    false,
                    NOW(),
                    NOW()
                );
            END;
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_service_order_insert');
    }
};

