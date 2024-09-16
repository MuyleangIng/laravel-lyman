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
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();
            $table->text('address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('profession', 500);
            $table->text('skills')->nullable();
            $table->text('experience')->nullable();
            $table->text('education')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('website')->nullable();
            $table->string('github')->nullable();
            $table->text('volunteer_interest')->nullable();
            $table->text('availability')->nullable();
            $table->text('previous_volunteering_experience')->nullable();
            $table->text('detail')->nullable();
            $table->string('cv_file')->nullable();
            $table->string('languages_spoken')->nullable();
            $table->text('emergency_contact')->nullable();
            $table->enum('status', ['pending', 'approve', 'reject'])->default('pending')->nullable();
            $table->timestamps();
        
            // Foreign key constraint to reference users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        }); 
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteers');
    }
};
