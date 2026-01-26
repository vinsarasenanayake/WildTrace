<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Using raw SQL for compatibility since change() often requires doctrine/dbal or specific driver support
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE products MODIFY description TEXT');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE products MODIFY description VARCHAR(255)');
    }
};
