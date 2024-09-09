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
            $table->string('objective');
            $table->text('expectations');
            $table->string('featured_photo');
            $table->integer('goal');
            $table->integer('raised')->nullable();
            $table->integer('number_of_participants')->default(0)->nullable();
            $table->string('is_featured')->nullable();
            $table->enum('status', ['pending', 'approve', 'reject'])->default('pending')->nullable();
            $table->text('legal_considerations')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->json('supporting_documents')->nullable();
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
