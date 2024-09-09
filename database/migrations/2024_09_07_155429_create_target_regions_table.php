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
        Schema::create('target_regions', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Name of the region (province/area)
            $table->timestamps();
        });
    
        // Insert Cambodian target regions (provinces or key areas)
        DB::table('target_regions')->insert([
            ['name' => 'Phnom Penh'],
            ['name' => 'Kandal'],
            ['name' => 'Battambang'],
            ['name' => 'Siem Reap'],
            ['name' => 'Kampong Cham'],
            ['name' => 'Kampot'],
            ['name' => 'Preah Sihanouk'],
            ['name' => 'Takeo'],
            ['name' => 'Banteay Meanchey'],
            ['name' => 'Kampong Thom'],
            ['name' => 'Kampong Speu'],
            ['name' => 'Prey Veng'],
            ['name' => 'Pursat'],
            ['name' => 'Kep'],
            ['name' => 'Pailin'],
            ['name' => 'Koh Kong'],
            ['name' => 'Mondulkiri'],
            ['name' => 'Ratanakiri'],
            ['name' => 'Stung Treng'],
            ['name' => 'Oddar Meanchey'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('target_regions');
    }
};
