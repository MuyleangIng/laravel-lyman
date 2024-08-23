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
        Schema::create('cause_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comment_id')->constrained('cause_comments')->onDelete('cascade');
            $table->string('name');
            $table->string('photo')->nullable();
            $table->text('reply');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cause_replies');
    }
};
