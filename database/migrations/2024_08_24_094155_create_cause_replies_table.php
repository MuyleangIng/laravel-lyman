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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key to track who made the reply
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->text('reply');

            // Foreign key constraint for parent_id to support nested replies
            $table->foreign('parent_id')
                  ->references('id')
                  ->on('cause_replies')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cause_replies', function (Blueprint $table) {
            // Drop the foreign key constraints
            $table->dropForeign(['comment_id']);
            $table->dropForeign(['parent_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('cause_replies');
    }
};
