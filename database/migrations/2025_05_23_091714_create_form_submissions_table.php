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
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('form_id');
            $table->json('submission_data'); // Store user answers
            $table->string('status')->default('submitted');
            $table->timestamp('submitted_at');
            $table->timestamps();

            // Add indexes
            $table->index('form_id');
            $table->index('status');
            $table->index('submitted_at');

            // Foreign key constraint
            $table->foreign('form_id')->references('form_id')->on('form_configurations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_submissions');
    }
};
