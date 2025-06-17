<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("
            CREATE TRIGGER after_service_created
                        AFTER INSERT ON service_requests
                        FOR EACH ROW
                        BEGIN
                            INSERT INTO notifications (
                                user_id,
                                title,
                                message,
                                type,
                                extra_data,
                                `read`,
                                created_at,
                                updated_at
                            )
                            SELECT u.id,
                                'Novo serviço publicado',
                                CONCAT('Eba! Um novo serviço já disponível: ', NEW.title),
                                'info',
                                NULL,
                                false,
                                NOW(),
                                NOW()
                            FROM users u
                            WHERE u.user_type = 'Professional';
                        END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS after_service_created");
    }
};
