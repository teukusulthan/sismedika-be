<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("CREATE TYPE user_role_enum AS ENUM ('waiter', 'cashier')");

        DB::statement("
            ALTER TABLE users
            ADD COLUMN role user_role_enum NOT NULL DEFAULT 'waiter'
        ");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE users DROP COLUMN role");
        DB::statement("DROP TYPE user_role_enum");
    }
};


