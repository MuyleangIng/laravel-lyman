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
        Schema::create('home_page_items', function (Blueprint $table) {
            $table->id();
            $table->string('cause_heading')->nullable();
            $table->string('cause_subheading')->nullable();
            $table->string('cause_status');
            $table->string('feature_background');
            $table->string('feature_status');
            $table->string('event_heading')->nullable();
            $table->string('event_subheading')->nullable();
            $table->string('event_status');
            $table->string('testimonial_heading')->nullable();
            $table->string('tesstimonial_background');
            $table->string('testimonial_status');
            $table->string('blog_heading')->nullable();
            $table->string('blog_subheading')->nullable();
            $table->string('blog_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_page_items');
    }
};
