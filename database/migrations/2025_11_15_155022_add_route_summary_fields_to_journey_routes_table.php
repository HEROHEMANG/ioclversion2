<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('journey_routes', function (Blueprint $table) {
            $table->decimal('total_distance_km', 10, 2)->nullable()->after('end_coords');
            $table->decimal('estimated_duration_hours', 5, 2)->nullable()->after('total_distance_km');
            $table->decimal('adjusted_duration_heavy_vehicle_hours', 5, 2)->nullable()->after('estimated_duration_hours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('journey_routes', function (Blueprint $table) {
            $table->dropColumn([
                'total_distance_km',
                'estimated_duration_hours',
                'adjusted_duration_heavy_vehicle_hours'
            ]);
        });
    }
};
