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
        Schema::create('target_audience_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('target_audience_categories')->insert([
            ['name' => 'Children and Youth'],
            ['name' => 'Educational Institutions'],
            ['name' => 'Low-Income Communities'],
            ['name' => 'Elderly'],
            ['name' => 'Individuals with Disabilities'],
            ['name' => 'Health and Wellness'],
            ['name' => 'Environment and Sustainability'],
            ['name' => 'Arts and Culture'],
            ['name' => 'Local Businesses'],
            ['name' => 'General Public'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('target_audience_categories');
    }
};
