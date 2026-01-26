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
        // Reordering and renaming for clarity and visibility
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE users DROP COLUMN country_code");
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE users CHANGE phone contact_number VARCHAR(255) AFTER email");
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE users MODIFY address VARCHAR(255) AFTER contact_number");
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE users MODIFY city VARCHAR(50) AFTER address");
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE users MODIFY postal_code VARCHAR(255) AFTER city");
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE users MODIFY country VARCHAR(255) AFTER postal_code");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No simple reversal for reordering without potentially breaking things
    }
};
