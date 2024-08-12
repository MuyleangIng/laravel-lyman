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
        Schema::create('causes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description');
            $table->text('description');
            $table->string('featured_photo');
            $table->integer('goal');
            $table->integer('raised')->nullable();
            $table->string('is_featured');
            $table->enum('status', ['pending', 'approve', 'reject'])->default('pending')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->integer('approved_by')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('causes');
    }
};
