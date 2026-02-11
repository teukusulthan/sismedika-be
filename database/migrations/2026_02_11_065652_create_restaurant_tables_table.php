<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            DO $$
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'table_status_enum') THEN
                    CREATE TYPE table_status_enum AS ENUM ('available', 'occupied');
                END IF;
            END$$;
        ");

        DB::statement("
            CREATE TABLE IF NOT EXISTS restaurant_tables (
                id BIGSERIAL PRIMARY KEY,
                number INTEGER UNIQUE NOT NULL,
                status table_status_enum NOT NULL DEFAULT 'available',
                created_at TIMESTAMP NULL,
                updated_at TIMESTAMP NULL
            )
        ");
    }

    public function down(): void
    {
        DB::statement("DROP TABLE IF EXISTS restaurant_tables");
    }
};
