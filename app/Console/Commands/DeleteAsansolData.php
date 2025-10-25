<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\JourneyRoute;

class DeleteAsansolData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:asansol-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all Asansol terminal and routes data from the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting deletion of Asansol terminal and routes data...');

        // Find all routes that contain "ASANSOL" in their name or destination
        $asansolRoutes = JourneyRoute::where(function($query) {
            $query->where('name', 'LIKE', '%ASANSOL%')
                  ->orWhere('destination', 'LIKE', '%ASANSOL%')
                  ->orWhere('source', 'LIKE', '%ASANSOL%');
        })->get();

        if ($asansolRoutes->isEmpty()) {
            $this->info('No Asansol-related routes found in the database.');
            return;
        }

        $this->info('Found ' . $asansolRoutes->count() . ' Asansol-related routes:');
        
        foreach ($asansolRoutes as $route) {
            $this->line('- ' . $route->name . ' (ID: ' . $route->id . ')');
        }

        if ($this->confirm('Do you want to delete these routes?')) {
            $deletedCount = 0;
            
            foreach ($asansolRoutes as $route) {
                $route->delete();
                $deletedCount++;
                $this->line('Deleted: ' . $route->name);
            }

            $this->info("Successfully deleted {$deletedCount} Asansol-related routes from the database.");
        } else {
            $this->info('Deletion cancelled.');
        }
    }
}