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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->text('long_description')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->string('image_url');
            $table->string('category');
            $table->string('location')->nullable();

            // Allow nullable for seeding flexibility if needed, but intended to be linked
            $table->foreignId('photographer_id')->nullable()->constrained('photographers')->onDelete('set null');

            // Technical details
            $table->string('aperture')->nullable();
            $table->string('shutter_speed')->nullable();
            $table->string('iso')->nullable();
            $table->string('focal_length')->nullable();

            // Options (Sizes, Prices, Colors)
            $table->json('options')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
