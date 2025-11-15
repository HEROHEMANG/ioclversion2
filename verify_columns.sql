-- Check if columns exist in journey_routes table
SHOW COLUMNS FROM journey_routes LIKE 'total_distance_km';
SHOW COLUMNS FROM journey_routes LIKE 'estimated_duration_hours';
SHOW COLUMNS FROM journey_routes LIKE 'adjusted_duration_heavy_vehicle_hours';

-- View all columns in the table
SHOW COLUMNS FROM journey_routes;

-- Check the data for JOY DURGA FILLING STATION
SELECT 
    id,
    name,
    total_distance_km,
    estimated_duration_hours,
    adjusted_duration_heavy_vehicle_hours,
    start_coords,
    end_coords
FROM journey_routes 
WHERE name = 'JOY DURGA FILLING STATION';

