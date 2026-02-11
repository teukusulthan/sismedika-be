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
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'user_role_enum') THEN
                    CREATE TYPE user_role_enum AS ENUM ('waiter', 'cashier');
                END IF;
            END$$;
        ");

        DB::statement("
            ALTER TABLE users
            ADD COLUMN IF NOT EXISTS role user_role_enum NOT NULL DEFAULT 'waiter'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE users
            DROP COLUMN IF EXISTS role
        ");
    }
};
