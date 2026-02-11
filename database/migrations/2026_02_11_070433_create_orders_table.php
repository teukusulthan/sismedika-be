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
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'order_status_enum') THEN
                    CREATE TYPE order_status_enum AS ENUM ('open', 'closed');
                END IF;
            END$$;
        ");

        DB::statement("
            CREATE TABLE IF NOT EXISTS orders (
                id BIGSERIAL PRIMARY KEY,
                table_id BIGINT NOT NULL,
                user_id BIGINT NOT NULL,
                status order_status_enum NOT NULL DEFAULT 'open',
                total_price NUMERIC(12,2) NOT NULL DEFAULT 0,
                closed_at TIMESTAMP NULL,
                created_at TIMESTAMP NULL,
                updated_at TIMESTAMP NULL,
                CONSTRAINT fk_orders_table
                    FOREIGN KEY(table_id)
                    REFERENCES restaurant_tables(id)
                    ON DELETE RESTRICT,
                CONSTRAINT fk_orders_user
                    FOREIGN KEY(user_id)
                    REFERENCES users(id)
                    ON DELETE RESTRICT
            )
        ");

        DB::statement("CREATE INDEX IF NOT EXISTS idx_orders_status ON orders(status)");
        DB::statement("CREATE INDEX IF NOT EXISTS idx_orders_table_id ON orders(table_id)");
    }

    public function down(): void
    {
        DB::statement("DROP TABLE IF EXISTS orders");
    }
};
