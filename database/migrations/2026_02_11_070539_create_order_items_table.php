<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE TABLE order_items (
                id BIGSERIAL PRIMARY KEY,
                order_id BIGINT NOT NULL,
                food_id BIGINT NOT NULL,
                quantity INTEGER NOT NULL,
                price NUMERIC(12,2) NOT NULL,
                subtotal NUMERIC(12,2) NOT NULL,
                created_at TIMESTAMP NULL,
                updated_at TIMESTAMP NULL,
                CONSTRAINT fk_order_items_order
                    FOREIGN KEY(order_id)
                    REFERENCES orders(id)
                    ON DELETE CASCADE,
                CONSTRAINT fk_order_items_food
                    FOREIGN KEY(food_id)
                    REFERENCES foods(id)
                    ON DELETE RESTRICT
            )
        ");

        DB::statement("CREATE INDEX idx_order_items_order_id ON order_items(order_id)");
        DB::statement("CREATE INDEX idx_order_items_food_id ON order_items(food_id)");
    }

    public function down(): void
    {
        DB::statement("DROP TABLE IF EXISTS order_items");
    }
};
