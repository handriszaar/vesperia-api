<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('form_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('form_id')->unique();
            $table->json('payloads'); // Store the form structure
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Add indexes for performance
            $table->index('form_id');
            $table->index('is_active');
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_configurations');
    }
};
