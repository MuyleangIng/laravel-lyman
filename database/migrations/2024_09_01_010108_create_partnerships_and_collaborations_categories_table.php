<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('partnership_and_collaboration_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('partnership_and_collaboration_categories')->insert([
            ['name' => 'Non-Profit Organizations'],
            ['name' => 'Government Agencies'],
            ['name' => 'Corporate Sponsors'],
            ['name' => 'Educational Institutions'],
            ['name' => 'Community Groups'],
            ['name' => 'Healthcare Providers'],
            ['name' => 'Media Partners'],
            ['name' => 'Local Businesses'],
            ['name' => 'Volunteer Organizations'],
            ['name' => 'International NGOs'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partnerships_and_collaborations_categories');
    }
};
