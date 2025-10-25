<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('journey_routes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('source')->nullable();
            $table->string('destination')->nullable();
            $table->json('start_coords');
            $table->json('end_coords');
            $table->json('risk_points')->nullable();
            $table->json('crowded_spots')->nullable();
            $table->json('emergency_locations')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journey_routes');
    }
};


