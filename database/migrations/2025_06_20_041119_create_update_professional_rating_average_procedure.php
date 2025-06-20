<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::unprepared("
            CREATE PROCEDURE UpdateProfessionalRatingAverage(IN p_user_id INT)
            BEGIN
                DECLARE avg_rating DECIMAL(2,1);

                SELECT AVG(rating)
                INTO avg_rating
                FROM evaluations
                WHERE professional_id = p_user_id;

                UPDATE users
                SET rating_average = avg_rating
                WHERE id = p_user_id;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS UpdateProfessionalRatingAverage");
    }
};
