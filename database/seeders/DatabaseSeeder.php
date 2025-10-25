<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JourneyRoute;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Update or create 370628 TALHA PETROLEUM route with accurate coordinates
        JourneyRoute::updateOrCreate(
            ['name' => '370628 TALHA PETROLEUM'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '370628 TALHA PETROLEUM',
                'start_coords' => [23.4764, 87.3975], // Start coordinates
                'end_coords' => [23.166678, 87.069098], // End coordinates
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.48581, 87.38619], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.48590, 87.38625], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.50385, 87.35293], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.49686, 87.32466], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.48803, 87.32008], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.48354, 87.30905], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.48346, 87.30906], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.31813, 87.22092], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.27643, 87.14436], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.27024, 87.11712], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.26561, 87.11169], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.26203, 87.10100], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.21060, 87.07199], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.20486, 87.06975], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.20341, 87.07039], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.20294, 87.06901], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.17702, 87.06772], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'description' => 'Manisha International School'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'Hospital', 'name' => 'Gouri Devi Hospital and Research Institute'],
                    ['coords' => [23.4978896, 87.324231], 'type' => 'Clinic', 'name' => 'Dreamland Nursing Home'],
                    ['coords' => [23.4916613, 87.3181652], 'type' => 'Clinic', 'name' => 'Vivek Nursing Home, Bardhaman'],
                    ['coords' => [23.4253715, 87.2812626], 'type' => 'Hospital', 'name' => 'Barjora Super Speciality Hospital'],
                    ['coords' => [23.2483699, 87.0851174], 'type' => 'Hospital', 'name' => 'Bankura Lions Eye Care Centre'],
                ],
            ]
        );

        // Update or create SUSHAMA SERVICE STATION route with accurate coordinates
        JourneyRoute::updateOrCreate(
            ['name' => '151113 SUSHAMA SERVICE STATION'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '151113 SUSHAMA SERVICE STATION',
                'start_coords' => [23.4764, 87.3975], // Rajbandh Terminal coordinates
                'end_coords' => [23.040581, 87.783377], // SUSHAMA SERVICE STATION coordinates
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'High', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.47970, 87.39733], 'risk' => 'High', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.48000, 87.39754], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.25924, 87.83353], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.22659, 87.84527], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.22660, 87.84539], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.22146, 87.85304], 'risk' => 'High', 'speed' => '10 KM/Hr'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'description' => 'Manisha International School'],
                    ['coords' => [23.2655419, 87.8260461], 'description' => 'Narayana School'],
                    ['coords' => [23.264854, 87.826075], 'description' => 'Sri Chaitanya Techno School'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'Hospital', 'name' => 'Gouri Devi Hospital and Research Institute'],
                    ['coords' => [23.3394688, 87.6905821], 'type' => 'Pharmacy', 'name' => 'LIFE CARE PHARMACY'],
                    ['coords' => [23.266198, 87.8269029], 'type' => 'Pharmacy', 'name' => 'Artim Enterprise Pharmacy'],
                    ['coords' => [23.2533793, 87.8325407], 'type' => 'Police Station', 'name' => 'Renaissance Township Police Outpost'],
                    ['coords' => [23.1099385, 87.803194], 'type' => 'Clinic', 'name' => 'Dakshin Damodar Nursing Home'],
                ],
            ]
        );

        // Add new route with provided data (Route 1)
        JourneyRoute::updateOrCreate(
            ['name' => '325887 SURAKSHA FILLING STATION'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '325887 SURAKSHA FILLING STATION',
                'start_coords' => [23.4764, 87.3975], // Start coordinates
                'end_coords' => [23.0838062, 87.9283231], // End coordinates
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.47970, 87.39733], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.48000, 87.39754], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.25924, 87.83353], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.22659, 87.84527], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.22660, 87.84539], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.22146, 87.85304], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.15688, 87.81619], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.10942, 87.86492], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.10854, 87.86754], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.10528, 87.86778], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.10049, 87.87168], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.10040, 87.87232], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.10031, 87.87238], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.09882, 87.87229], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.09863, 87.87252], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.09797, 87.87258], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.09749, 87.87299], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.09703, 87.87297], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.07406, 87.89504], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.07413, 87.89528], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.2655419, 87.8260461], 'type' => 'school', 'name' => 'Narayana School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.264854, 87.826075], 'type' => 'school', 'name' => 'Sri Chaitanya Techno School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.102762, 87.8696108], 'type' => 'school', 'name' => 'Shyamsundar Adarsa Balika Vidyalaya', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.1027167, 87.8683886], 'type' => 'school', 'name' => 'Ramlal Adarsha Vidyalaya', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.0753668, 87.9058743], 'type' => 'marketplace', 'name' => 'Raina Hat', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.3394688, 87.6905821], 'type' => 'pharmacy', 'name' => 'LIFE CARE PHARMACY', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.266198, 87.8269029], 'type' => 'pharmacy', 'name' => 'Artim Enterprise Pharmacy', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.2533793, 87.8325407], 'type' => 'police', 'name' => 'Renaissance Township Police Outpost', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.1103094, 87.8680976], 'type' => 'police', 'name' => 'Raina Police Station', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.1053879, 87.8679294], 'type' => 'pharmacy', 'name' => 'Shyamsundar Medicine Shop', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.0752897, 87.9056876], 'type' => 'pharmacy', 'name' => 'Nandi Medicine', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.0753107, 87.9056164], 'type' => 'pharmacy', 'name' => 'New Life Homeo Pharmacy', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]
        );

        // Add second new route with provided data (Route 2)
        JourneyRoute::updateOrCreate(
            ['name' => '331691 SRO ASANSOL ADHOC'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '331691 SRO ASANSOL ADHOC',
                'start_coords' => [23.4764, 87.3975], // Start coordinates
                'end_coords' => [23.716195, 86.95314], // End coordinates
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.48581, 87.38619], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.48590, 87.38625], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.71430, 86.96038], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.71426, 86.96032], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.71647, 86.95338], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5104822, 87.3487806], 'type' => 'school', 'name' => 'St. Michael\'s School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5903412, 87.2063802], 'type' => 'school', 'name' => 'School Ground', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.712477, 86.9493796], 'type' => 'school', 'name' => 'Asansol Ramkrishna Mission High School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5333414, 87.2936229], 'type' => 'hospital', 'name' => 'Disha Eye Hospitals And Research Centre Pvt Ltd', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5743581, 87.2363759], 'type' => 'clinic', 'name' => 'West End Nursing Home and Maternity Centre', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]
        );

        // Add SRO ASANSOL route from JSON data
        JourneyRoute::updateOrCreate(
            ['name' => '278634 SRO-ASANSOL'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '278634 SRO-ASANSOL',
                'start_coords' => [23.4764, 87.3975], // Start coordinates
                'end_coords' => [23.716294, 86.953261], // End coordinates
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.48581, 87.38619], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.48590, 87.38625], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.71430, 86.96038], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.71426, 86.96032], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.71647, 86.95338], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5104822, 87.3487806], 'type' => 'school', 'name' => 'St. Michael\'s School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5903412, 87.2063802], 'type' => 'school', 'name' => 'School Ground', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.712477, 86.9493796], 'type' => 'school', 'name' => 'Asansol Ramkrishna Mission High School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5333414, 87.2936229], 'type' => 'hospital', 'name' => 'Disha Eye Hospitals And Research Centre Pvt Ltd', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5743581, 87.2363759], 'type' => 'clinic', 'name' => 'West End Nursing Home and Maternity Centre', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]
        );

        // Add TEWARY PETROL PUMP route from JSON data
        JourneyRoute::updateOrCreate(
            ['name' => '366312 TEWARY PETROL PUMP'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '366312 TEWARY PETROL PUMP',
                'start_coords' => [23.4764, 87.3975], // Start coordinates
                'end_coords' => [23.638595, 87.274895], // End coordinates
                'risk_points' => [
                    ['coords' => [23.55138, 87.29621], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.55514, 87.29856], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.55945, 87.29858], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.56124, 87.29865], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.56833, 87.29862], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.57047, 87.29500], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.57267, 87.29107], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.48581, 87.38619], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.48590, 87.38625], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.53414, 87.29810], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.53406, 87.29804], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.53945, 87.28813], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.57597, 87.28729], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.57597, 87.28714], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.57611, 87.28705], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.57853, 87.28267], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.58012, 87.28346], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.58016, 87.28352], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.58034, 87.28427], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.58271, 87.28354], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.58861, 87.28192], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.58804, 87.28132], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.60009, 87.27773], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.62363, 87.28672], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.62478, 87.28505], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.63261, 87.28463], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.63446, 87.28333], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.63711, 87.28384], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.63840, 87.27507], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5104822, 87.3487806], 'type' => 'school', 'name' => 'St. Michael\'s School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.549085, 87.2909251], 'type' => 'university', 'name' => 'National Institute Of Technology, Durgapur', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5467136, 87.2922897], 'type' => 'crossing', 'name' => 'NIT Durgapur Main Gate', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5697727, 87.2996971], 'type' => 'school', 'name' => 'Carmel School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5333414, 87.2936229], 'type' => 'hospital', 'name' => 'Disha Eye Hospitals And Research Centre Pvt Ltd', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]
        );

        // Add 141289 VETERAN SERVICE STATION ODR route from JSON data
        JourneyRoute::updateOrCreate(
            ['name' => '141289 VETERAN SERVICE STATION  ODR'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '141289 VETERAN SERVICE STATION  ODR',
                'start_coords' => [23.4764, 87.3975], // Start coordinates
                'end_coords' => [23.682753, 86.984821], // End coordinates
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.48581, 87.38619], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.48590, 87.38625], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.67524, 87.01223], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.67521, 87.01220], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5104822, 87.3487806], 'type' => 'school', 'name' => 'St. Michael\'s School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5903412, 87.2063802], 'type' => 'school', 'name' => 'School Ground', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5333414, 87.2936229], 'type' => 'hospital', 'name' => 'Disha Eye Hospitals And Research Centre Pvt Ltd', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5743581, 87.2363759], 'type' => 'clinic', 'name' => 'West End Nursing Home and Maternity Centre', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]
        );

        // Add 190569 SUBHAM FILLING STATION route from JSON data
        JourneyRoute::updateOrCreate(
            ['name' => '190569 SUBHAM FILLING STATION'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '190569 SUBHAM FILLING STATION',
                'start_coords' => [23.4764, 87.3975], // Start coordinates
                'end_coords' => [23.21607, 87.680718], // End coordinates
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.47970, 87.39733], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.48000, 87.39754], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.25924, 87.83353], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.22659, 87.84527], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.22660, 87.84539], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.22146, 87.85304], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.18827, 87.83170], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.21928, 87.78690], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.2655419, 87.8260461], 'type' => 'school', 'name' => 'Narayana School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.264854, 87.826075], 'type' => 'school', 'name' => 'Sri Chaitanya Techno School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.3394688, 87.6905821], 'type' => 'pharmacy', 'name' => 'LIFE CARE PHARMACY', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.266198, 87.8269029], 'type' => 'pharmacy', 'name' => 'Artim Enterprise Pharmacy', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.2533793, 87.8325407], 'type' => 'police', 'name' => 'Renaissance Township Police Outpost', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]
        );

        // Add COCO PANDAVESWAR-ADHOC SHIVA VISHNU route from JSON data
        JourneyRoute::updateOrCreate(
            ['name' => '322734 COCO PANDAVESWAR-ADHOC SHIVA VISHNU'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '322734 COCO PANDAVESWAR-ADHOC SHIVA VISHNU',
                'start_coords' => [23.4764, 87.3975], // Start coordinates
                'end_coords' => [23.72461, 87.27386], // End coordinates
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.48581, 87.38619], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.48590, 87.38625], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.58984, 87.20548], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.65271, 87.23313], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.65333, 87.23836], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.65709, 87.23697], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.65734, 87.23726], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.65748, 87.23732], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.66586, 87.23995], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.66591, 87.24003], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.67060, 87.24628], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.67064, 87.24635], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.67292, 87.24710], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.67349, 87.24674], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.67394, 87.24524], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.67588, 87.24867], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.67597, 87.24952], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.70421, 87.26774], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.70457, 87.26766], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.70475, 87.26747], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.70582, 87.26193], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.70588, 87.26191], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.70828, 87.26379], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5104822, 87.3487806], 'type' => 'school', 'name' => 'St. Michael\'s School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5903412, 87.2063802], 'type' => 'school', 'name' => 'School Ground', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5333414, 87.2936229], 'type' => 'hospital', 'name' => 'Disha Eye Hospitals And Research Centre Pvt Ltd', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5743581, 87.2363759], 'type' => 'clinic', 'name' => 'West End Nursing Home and Maternity Centre', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.6527157, 87.2348718], 'type' => 'clinic', 'name' => 'Ukhra K.P. Nursing Home', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.6535064, 87.2404752], 'type' => 'pharmacy', 'name' => 'SUMAN MEDICAL STORE', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]
        );

        // Add new routes from the 5 folders in public directory
        // Route 1: 138510-Rajbandh Service station-NH-2
        JourneyRoute::updateOrCreate(
            ['name' => '138510 Rajbandh Service station-NH-2'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '138510 Rajbandh Service station-NH-2',
                'start_coords' => [23.4764, 87.3975],
                'end_coords' => [23.476305, 87.402886],
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.47970, 87.39733], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48000, 87.39754], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.47858, 87.39994], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.46448, 87.42580], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.46416, 87.42559], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.46611, 87.42215], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.46618, 87.42211], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.47314, 87.40938], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.47311, 87.40927], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]
        );

        // Route 2: 139296-Dy Commisioner of Police ,ASl-DGP
        JourneyRoute::updateOrCreate(
            ['name' => '139296 Dy Commisioner of Police ,ASl-DGP'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '139296 Dy Commisioner of Police ,ASl-DGP',
                'start_coords' => [23.4764, 87.3975],
                'end_coords' => [23.692595, 86.949674],
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48581, 87.38619], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48590, 87.38625], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.69299, 86.99305], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.69301, 86.99305], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.71430, 86.96038], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.71427, 86.96035], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.71667, 86.95260], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.69395, 86.95145], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.69391, 86.95147], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.69383, 86.95143], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.69383, 86.95134], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5104822, 87.3487806], 'type' => 'school', 'name' => 'St. Michael\'s School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5903412, 87.2063802], 'type' => 'school', 'name' => 'School Ground', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.712477, 86.9493796], 'type' => 'school', 'name' => 'Asansol Ramkrishna Mission High School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5333414, 87.2936229], 'type' => 'hospital', 'name' => 'Disha Eye Hospitals And Research Centre Pvt Ltd', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5743581, 87.2363759], 'type' => 'clinic', 'name' => 'West End Nursing Home and Maternity Centre', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.7095131, 86.9537334], 'type' => 'hospital', 'name' => 'ই এস আই হাসপাতাল', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.704757, 86.9521657], 'type' => 'hospital', 'name' => 'Punardristee Eye and General Hospital', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.7044488, 86.95315], 'type' => 'hospital', 'name' => 'H L G Memorial Charitable Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.6961845, 86.9527027], 'type' => 'clinic', 'name' => 'New Eveland Nursing Home', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.6954323, 86.9486301], 'type' => 'hospital', 'name' => 'Kamalalaya Hospital (P) Ltd.,', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]
        );

        // Route 3: GEETA FILLING STATION 139346
        JourneyRoute::updateOrCreate(
            ['name' => '139346 GEETA FILLING STATION'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '139346 GEETA FILLING STATION',
                'start_coords' => [23.4764, 87.3975],
                'end_coords' => [23.3102, 87.399789],
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48581, 87.38619], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48590, 87.38625], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.50385, 87.35293], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.48354, 87.30905], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.48346, 87.30906], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.32191, 87.22326], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.31810, 87.22873], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.31800, 87.22878], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.4978896, 87.324231], 'type' => 'clinic', 'name' => 'Dreamland Nursing Home', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.4916613, 87.3181652], 'type' => 'clinic', 'name' => 'Vivek Nursing Home, Bardhaman', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.4253715, 87.2812626], 'type' => 'hospital', 'name' => 'Barjora Super Speciality Hospital', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]
        );

        // Route 4: JAYSWAL AUTO SERVICE 139353
        JourneyRoute::updateOrCreate(
            ['name' => '139353 JAYSWAL AUTO SERVICE'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '139353 JAYSWAL AUTO SERVICE',
                'start_coords' => [23.4764, 87.3975],
                'end_coords' => [23.626634, 87.114397],
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48581, 87.38619], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48590, 87.38625], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.63157, 87.12615], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.63155, 87.12599], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.63746, 87.11567], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5104822, 87.3487806], 'type' => 'school', 'name' => 'St. Michael\'s School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5903412, 87.2063802], 'type' => 'school', 'name' => 'School Ground', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5333414, 87.2936229], 'type' => 'hospital', 'name' => 'Disha Eye Hospitals And Research Centre Pvt Ltd', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5743581, 87.2363759], 'type' => 'clinic', 'name' => 'West End Nursing Home and Maternity Centre', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.630409, 87.1148524], 'type' => 'clinic', 'name' => 'Raniganj Nursing Home, Bardhaman', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.6309975, 87.1154331], 'type' => 'clinic', 'name' => 'Seba Nursing Home', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.633303, 87.1140363], 'type' => 'hospital', 'name' => 'Anandalok Hospital', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.6303232, 87.113309], 'type' => 'hospital', 'name' => 'Kumar P. N Malaiah Hospital', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]
        );

        // Route 5: NIRMALA SERVICE STATION 139384
        JourneyRoute::updateOrCreate(
            ['name' => '139384 NIRMALA SERVICE STATION'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '139384 NIRMALA SERVICE STATION',
                'start_coords' => [23.4764, 87.3975],
                'end_coords' => [23.555965, 87.299471],
                'risk_points' => [
                    ['coords' => [23.55138, 87.29621], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Roundabout'],
                    ['coords' => [23.55514, 87.29856], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Roundabout'],
                    ['coords' => [23.55945, 87.29858], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Roundabout'],
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48581, 87.38619], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48590, 87.38625], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.53414, 87.29810], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.53406, 87.29804], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.53945, 87.28813], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.55584, 87.29874], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.55578, 87.29911], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.55583, 87.29915], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5104822, 87.3487806], 'type' => 'school', 'name' => 'St. Michael\'s School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.549085, 87.2909251], 'type' => 'university', 'name' => 'National Institute Of Technology, Durgapur', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5467136, 87.2922897], 'type' => 'crossing', 'name' => 'NIT Durgapur Main Gate', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5333414, 87.2936229], 'type' => 'hospital', 'name' => 'Disha Eye Hospitals And Research Centre Pvt Ltd', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]
        );

        // Add 5 more routes from the additional folders
        // Route 6: 139389 PATESARIA BROTHERS
        JourneyRoute::updateOrCreate(
            ['name' => '139389 PATESARIA BROTHERS'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '139389 PATESARIA BROTHERS',
                'start_coords' => [23.4764, 87.3975],
                'end_coords' => [23.653492, 87.087466],
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48581, 87.38619], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48590, 87.38625], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5104822, 87.3487806], 'type' => 'school', 'name' => 'St. Michael\'s School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5903412, 87.2063802], 'type' => 'school', 'name' => 'School Ground', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5333414, 87.2936229], 'type' => 'hospital', 'name' => 'Disha Eye Hospitals And Research Centre Pvt Ltd', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5743581, 87.2363759], 'type' => 'clinic', 'name' => 'West End Nursing Home and Maternity Centre', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]
        );

        // Route 7: DVC-DTPC 138438
        JourneyRoute::updateOrCreate(
            ['name' => '138438 DVC-DTPC'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '138438 DVC-DTPC',
                'start_coords' => [23.4764, 87.3975],
                'end_coords' => [23.531244, 87.252001],
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48581, 87.38619], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48590, 87.38625], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.53414, 87.29810], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.53406, 87.29804], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.53930, 87.28840], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.53925, 87.28813], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.52547, 87.26113], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.53100, 87.25159], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.53122, 87.25184], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5104822, 87.3487806], 'type' => 'school', 'name' => 'St. Michael\'s School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5333414, 87.2936229], 'type' => 'hospital', 'name' => 'Disha Eye Hospitals And Research Centre Pvt Ltd', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5259167, 87.2552453], 'type' => 'hospital', 'name' => 'DTPS Hospital', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]
        );

        // Route 8: EUREKA FILLING STATION 139332
        JourneyRoute::updateOrCreate(
            ['name' => '139332 EUREKA FILLING STATION'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '139332 EUREKA FILLING STATION',
                'start_coords' => [23.4764, 87.3975],
                'end_coords' => [23.110122, 87.864684],
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.47970, 87.39733], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48000, 87.39754], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.25924, 87.83353], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.22659, 87.84527], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.22663, 87.84532], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.22146, 87.85304], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.15694, 87.81614], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.2655419, 87.8260461], 'type' => 'school', 'name' => 'Narayana School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.264854, 87.826075], 'type' => 'school', 'name' => 'Sri Chaitanya Techno School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.3394688, 87.6905821], 'type' => 'pharmacy', 'name' => 'LIFE CARE PHARMACY', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.266198, 87.8269029], 'type' => 'pharmacy', 'name' => 'Artim Enterprise Pharmacy', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.2533793, 87.8325407], 'type' => 'police', 'name' => 'Renaissance Township Police Outpost', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]
        );

        // Route 9: HIMAGIRI SERVICE STN -SH9139349
        JourneyRoute::updateOrCreate(
            ['name' => '139349 HIMAGIRI SERVICE STN -SH9'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '139349 HIMAGIRI SERVICE STN -SH9',
                'start_coords' => [23.4764, 87.3975],
                'end_coords' => [23.317943, 87.213711],
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48581, 87.38619], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48590, 87.38625], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48354, 87.30905], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.48346, 87.30906], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.47157, 87.29925], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.31894, 87.22145], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.31891, 87.22139], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.31813, 87.22092], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.4978896, 87.324231], 'type' => 'clinic', 'name' => 'Dreamland Nursing Home', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.4916613, 87.3181652], 'type' => 'clinic', 'name' => 'Vivek Nursing Home, Bardhaman', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.4253715, 87.2812626], 'type' => 'hospital', 'name' => 'Barjora Super Speciality Hospital', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]
        );

        // Route 10: JAYSWAL AUTOMOBILES 139534
        JourneyRoute::updateOrCreate(
            ['name' => '139534 JAYSWAL AUTOMOBILES'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '139534 JAYSWAL AUTOMOBILES',
                'start_coords' => [23.4764, 87.3975],
                'end_coords' => [23.63876, 87.11327],
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48581, 87.38619], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48590, 87.38625], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.63157, 87.12615], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.63155, 87.12599], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5104822, 87.3487806], 'type' => 'school', 'name' => 'St. Michael\'s School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5903412, 87.2063802], 'type' => 'school', 'name' => 'School Ground', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5333414, 87.2936229], 'type' => 'hospital', 'name' => 'Disha Eye Hospitals And Research Centre Pvt Ltd', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5743581, 87.2363759], 'type' => 'clinic', 'name' => 'West End Nursing Home and Maternity Centre', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]
        );

        // Add 6 more routes from the additional folders
        // Route 11: 139323 DUBRAJPUR AUTO CENTRE
        JourneyRoute::updateOrCreate(
            ['name' => '139323 DUBRAJPUR AUTO CENTRE'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '139323 DUBRAJPUR AUTO CENTRE',
                'start_coords' => [23.4764, 87.3975],
                'end_coords' => [23.797863, 87.397567],
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.47970, 87.39733], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48000, 87.39754], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.45759, 87.43811], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.45767, 87.43806], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.46069, 87.45143], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.53310, 87.45967], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.62767, 87.54149], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.64002, 87.52830], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.79659, 87.39732], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.62442, 87.539217], 'type' => 'hospital', 'name' => 'Illambazar Rural Hospital', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]
        );

        // Route 12: 139327 DURGA DEVI FILLING STATION
        JourneyRoute::updateOrCreate(
            ['name' => '139327 DURGA DEVI FILLING STATION'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '139327 DURGA DEVI FILLING STATION',
                'start_coords' => [23.4764, 87.3975],
                'end_coords' => [23.838885, 87.473018],
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.47970, 87.39733], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48000, 87.39754], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.45759, 87.43811], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.45767, 87.43806], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.46069, 87.45143], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.53310, 87.45967], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.62767, 87.54149], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.64002, 87.52830], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.83824, 87.47317], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.62442, 87.539217], 'type' => 'hospital', 'name' => 'Illambazar Rural Hospital', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]
        );

        // Route 13: 139356 JAS FILLING STATION NH60
        JourneyRoute::updateOrCreate(
            ['name' => '139356 JAS FILLING STATION NH60'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '139356 JAS FILLING STATION NH60',
                'start_coords' => [23.4764, 87.3975],
                'end_coords' => [23.890048, 87.517593],
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.47970, 87.39733], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.47997, 87.39762], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.45759, 87.43811], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.45770, 87.43814], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.46069, 87.45143], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.53310, 87.45967], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.62767, 87.54149], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.64002, 87.52830], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.78142, 87.40444], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.78338, 87.40571], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.78449, 87.40581], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.79655, 87.39734], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.88601, 87.52056], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.89087, 87.51765], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.89040, 87.51705], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.89032, 87.51723], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.62442, 87.539217], 'type' => 'hospital', 'name' => 'Illambazar Rural Hospital', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]
        );

        // Route 14: 139375 MT AUTOMOBILES
        JourneyRoute::updateOrCreate(
            ['name' => '139375 MT AUTOMOBILES'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '139375 MT AUTOMOBILES',
                'start_coords' => [23.4764, 87.3975],
                'end_coords' => [23.652859, 87.236123],
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48581, 87.38619], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48590, 87.38625], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.58984, 87.20548], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.65271, 87.23313], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.65304, 87.23599], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5104822, 87.3487806], 'type' => 'school', 'name' => 'St. Michael\'s School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5903412, 87.2063802], 'type' => 'school', 'name' => 'School Ground', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5333414, 87.2936229], 'type' => 'hospital', 'name' => 'Disha Eye Hospitals And Research Centre Pvt Ltd', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.5743581, 87.2363759], 'type' => 'clinic', 'name' => 'West End Nursing Home and Maternity Centre', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.6527157, 87.2348718], 'type' => 'clinic', 'name' => 'Ukhra K.P. Nursing Home', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]
        );

        // Route 15: 139383 NILKANTHA AUTO SERVICE
        JourneyRoute::updateOrCreate(
            ['name' => '139383 NILKANTHA AUTO SERVICE'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '139383 NILKANTHA AUTO SERVICE',
                'start_coords' => [23.4764, 87.3975],
                'end_coords' => [23.219426, 87.899829],
                'risk_points' => [
                    ['coords' => [23.2198352, 87.90542719999999], 'risk' => 'High', 'speed' => '10 KM/Hr', 'type' => 'U-Turn'],
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.47970, 87.39733], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.48000, 87.39754], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.25924, 87.83353], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.21976, 87.89671], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.21986, 87.89681], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.21984, 87.90543], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.21964, 87.90536], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.2655419, 87.8260461], 'type' => 'school', 'name' => 'Narayana School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.264854, 87.826075], 'type' => 'school', 'name' => 'Sri Chaitanya Techno School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.3394688, 87.6905821], 'type' => 'pharmacy', 'name' => 'LIFE CARE PHARMACY', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.266198, 87.8269029], 'type' => 'pharmacy', 'name' => 'Artim Enterprise Pharmacy', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.2533793, 87.8325407], 'type' => 'police', 'name' => 'Renaissance Township Police Outpost', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.2203218, 87.9069771], 'type' => 'hospital', 'name' => 'Sharanya Multispeciality Hospital', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]
        );

        // Route 16: KARGIL SHD 139359
        JourneyRoute::updateOrCreate(
            ['name' => '139359 KARGIL SHD'],
            [
                'source' => 'Rajbandh Terminal',
                'destination' => '139359 KARGIL SHD',
                'start_coords' => [23.4764, 87.3975],
                'end_coords' => [24.00316, 87.578096],
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.47970, 87.39733], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr', 'type' => 'Blind Spot'],
                    ['coords' => [23.47997, 87.39762], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.45759, 87.43811], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.45770, 87.43814], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.46069, 87.45143], 'risk' => 'High', 'speed' => '15 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.53233, 87.45840], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.53310, 87.45967], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.53530, 87.46034], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.56860, 87.50110], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.62767, 87.54149], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.62813, 87.54128], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.63500, 87.53146], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.64002, 87.52830], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.78142, 87.40444], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.78338, 87.40571], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.78449, 87.40581], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.79056, 87.39914], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.79655, 87.39734], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.88601, 87.52056], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.93258, 87.52179], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.93325, 87.52240], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.93324, 87.52614], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.97395, 87.53692], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.97322, 87.54207], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [23.99787, 87.57650], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                    ['coords' => [24.00205, 87.57707], 'risk' => 'Medium', 'speed' => '30 KM/Hr', 'type' => 'Turn'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.62442, 87.539217], 'type' => 'hospital', 'name' => 'Illambazar Rural Hospital', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.9098564, 87.5160961], 'type' => 'clinic', 'name' => 'Suri Nursing Home, Birbhum', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.9159428, 87.5168148], 'type' => 'hospital', 'name' => 'Suri Sadar Hospital', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.9228527, 87.5179844], 'type' => 'hospital', 'name' => 'Indralok Speciality Centre', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]
        );

        // Seed example routes (one full, four placeholders) - only if no routes exist
        if (JourneyRoute::count() <= 3) {
            JourneyRoute::create([
                'name' => '139358- AI JRM_ JYOTIRMOY SERVICE STATION -SH5',
                'source' => 'Rajbandh Terminal',
                'destination' => '139358- AI JRM_ JYOTIRMOY SERVICE STATION -SH5',
                'start_coords' => [23.4764, 87.3975],
                'end_coords' => [23.070605, 86.662136],
                'risk_points' => [
                    [ 'coords' => [23.47611, 87.39874], 'risk' => 'High', 'speed' => '15 KM/Hr' ],
                    [ 'coords' => [23.47797, 87.40013], 'risk' => 'High', 'speed' => '15 KM/Hr' ],
                    [ 'coords' => [23.50385, 87.35293], 'risk' => 'High', 'speed' => '15 KM/Hr' ],
                    [ 'coords' => [23.49686, 87.32466], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.48828, 87.32023], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.31813, 87.22092], 'risk' => 'High', 'speed' => '15 KM/Hr' ],
                    [ 'coords' => [23.31721, 87.20891], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.30885, 87.20269], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.28938, 87.16912], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.28796, 87.15486], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.27636, 87.14433], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.27515, 87.14409], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.27062, 87.13529], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.26835, 87.12110], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.27029, 87.11761], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.27020, 87.11703], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.26558, 87.11164], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.26199, 87.10097], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.25843, 87.09413], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.24780, 87.08384], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.24646, 87.08322], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.21972, 87.08585], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.21067, 87.07205], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.20492, 87.06976], 'risk' => 'High', 'speed' => '15 KM/Hr' ],
                    [ 'coords' => [23.09173, 86.90615], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.08519, 86.91025], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.07030, 86.90090], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.06830, 86.90010], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.06577, 86.88150], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.06206, 86.87847], 'risk' => 'High', 'speed' => '15 KM/Hr' ],
                    [ 'coords' => [23.08956, 86.73542], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.08221, 86.71025], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.07274, 86.69732], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.07035, 86.69123], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.06572, 86.6379], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr' ],
                ],
                'crowded_spots' => [
                    [ 'coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 KM/Hr', 'risk' => 'Medium' ],
                    [ 'coords' => [23.2073304, 87.0280952], 'type' => 'college', 'name' => 'Bankura Unnayani Institute of Engineering', 'speed' => '30 KM/Hr', 'risk' => 'Medium' ],
                    [ 'coords' => [23.1571509, 86.9205538], 'type' => 'school', 'name' => 'Indpur Goenka High School', 'speed' => '30 KM/Hr', 'risk' => 'Medium' ],
                ],
                'emergency_locations' => [
                    [ 'coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 KM/Hr', 'risk' => 'Medium' ],
                    [ 'coords' => [23.4978896, 87.324231], 'type' => 'clinic', 'name' => 'Dreamland Nursing Home', 'speed' => '30 KM/Hr', 'risk' => 'Medium' ],
                    [ 'coords' => [23.4916613, 87.3181652], 'type' => 'clinic', 'name' => 'Vivek Nursing Home, Bardhaman', 'speed' => '30 KM/Hr', 'risk' => 'Medium' ],
                    [ 'coords' => [23.2483699, 87.0851174], 'type' => 'hospital', 'name' => 'Bankura Lions Eye Care Centre', 'speed' => '30 KM/Hr', 'risk' => 'Medium' ],
                    [ 'coords' => [23.155047, 86.9221434], 'type' => 'hospital', 'name' => 'Indpur Rural Hospital', 'speed' => '30 KM/Hr', 'risk' => 'Medium' ],
                ],
            ]);

            // Second route: Rajbandh Terminal to SUPDT.OF POLICE,BANKURA
            JourneyRoute::create([
                'name' => 'Rajbandh Terminal → SUPDT.OF POLICE,BANKURA',
                'source' => 'Rajbandh Terminal',
                'destination' => 'SUPDT.OF POLICE,BANKURA',
                'start_coords' => [23.4764, 87.3975],
                'end_coords' => [23.234018, 87.060231],
                'risk_points' => [
                    [ 'coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr' ],
                    [ 'coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr' ],
                    [ 'coords' => [23.48581, 87.38619], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr' ],
                    [ 'coords' => [23.48590, 87.38625], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr' ],
                    [ 'coords' => [23.50385, 87.35293], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.49686, 87.32466], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.48803, 87.32008], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.48354, 87.30905], 'risk' => 'High', 'speed' => '15 KM/Hr' ],
                    [ 'coords' => [23.48346, 87.30906], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.31813, 87.22092], 'risk' => 'High', 'speed' => '15 KM/Hr' ],
                    [ 'coords' => [23.27643, 87.14436], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.26561, 87.11169], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.26203, 87.10100], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.23435, 87.07200], 'risk' => 'High', 'speed' => '15 KM/Hr' ],
                    [ 'coords' => [23.23571, 87.06716], 'risk' => 'Medium', 'speed' => '30 KM/Hr' ],
                    [ 'coords' => [23.23506, 87.06632], 'risk' => 'High', 'speed' => '15 KM/Hr' ],
                    [ 'coords' => [23.23510, 87.06603], 'risk' => 'High', 'speed' => '15 KM/Hr' ],
                    [ 'coords' => [23.23493, 87.06594], 'risk' => 'High', 'speed' => '15 KM/Hr' ],
                    [ 'coords' => [23.23397, 87.06075], 'risk' => 'High', 'speed' => '15 KM/Hr' ],
                ],
                'emergency_locations' => [
                    [ 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'coords' => [23.4768156, 87.4014877], 'speed_limit' => '30 km/h', 'risk_level' => 'Medium' ],
                    [ 'type' => 'clinic', 'name' => 'Dreamland Nursing Home', 'coords' => [23.4978896, 87.324231], 'speed_limit' => '30 km/h', 'risk_level' => 'Medium' ],
                    [ 'type' => 'clinic', 'name' => 'Vivek Nursing Home, Bardhaman', 'coords' => [23.4916613, 87.3181652], 'speed_limit' => '30 km/h', 'risk_level' => 'Medium' ],
                    [ 'type' => 'hospital', 'name' => 'Barjora Super Speciality Hospital', 'coords' => [23.4253715, 87.2812626], 'speed_limit' => '30 km/h', 'risk_level' => 'Medium' ],
                    [ 'type' => 'hospital', 'name' => 'Bankura Lions Eye Care Centre', 'coords' => [23.2483699, 87.0851174], 'speed_limit' => '30 km/h', 'risk_level' => 'Medium' ],
                    [ 'type' => 'clinic', 'name' => 'ECHS Polyclinic', 'coords' => [23.234594, 87.064904], 'speed_limit' => '30 km/h', 'risk_level' => 'Medium' ],
                    [ 'type' => 'hospital', 'name' => 'Sadar Hospital', 'coords' => [23.232244, 87.063068], 'speed_limit' => '30 km/h', 'risk_level' => 'Medium' ],
                ],
                'crowded_spots' => [
                    [ 'type' => 'school', 'name' => 'Manisha International School', 'coords' => [23.4755227, 87.4024908], 'speed_limit' => '30 km/h', 'risk_level' => 'Medium' ],
                ],
            ]);

            // TALHA PETROLEUM Route - 370628
            JourneyRoute::create([
                'name' => '370628 TALHA PETROLEUM',
                'source' => 'Rajbandh Terminal',
                'destination' => 'TALHA PETROLEUM',
                'start_coords' => [23.4764, 87.3975], // Rajbandh Terminal coordinates
                'end_coords' => [23.040581, 87.783377], // TALHA PETROLEUM coordinates
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'High', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.47970, 87.39733], 'risk' => 'High', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.48000, 87.39754], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.25924, 87.83353], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.22659, 87.84527], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.22660, 87.84539], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.22146, 87.85304], 'risk' => 'High', 'speed' => '10 KM/Hr'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'description' => 'Manisha International School'],
                    ['coords' => [23.2655419, 87.8260461], 'description' => 'Narayana School'],
                    ['coords' => [23.264854, 87.826075], 'description' => 'Sri Chaitanya Techno School'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'Hospital', 'name' => 'Gouri Devi Hospital and Research Institute'],
                    ['coords' => [23.3394688, 87.6905821], 'type' => 'Pharmacy', 'name' => 'LIFE CARE PHARMACY'],
                    ['coords' => [23.266198, 87.8269029], 'type' => 'Pharmacy', 'name' => 'Artim Enterprise Pharmacy'],
                    ['coords' => [23.2533793, 87.8325407], 'type' => 'Police Station', 'name' => 'Renaissance Township Police Outpost'],
                    ['coords' => [23.1099385, 87.803194], 'type' => 'Clinic', 'name' => 'Dakshin Damodar Nursing Home'],
                ],
            ]);

            // SUSHAMA SERVICE STATION Route - 151113
            JourneyRoute::create([
                'name' => '151113 SUSHAMA SERVICE STATION',
                'source' => 'Rajbandh Terminal',
                'destination' => '151113 SUSHAMA SERVICE STATION',
                'start_coords' => [23.4764, 87.3975], // Rajbandh Terminal coordinates
                'end_coords' => [23.040581, 87.783377], // SUSHAMA SERVICE STATION coordinates
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'High', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.47970, 87.39733], 'risk' => 'High', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.48000, 87.39754], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.25924, 87.83353], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.22659, 87.84527], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.22660, 87.84539], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.22146, 87.85304], 'risk' => 'High', 'speed' => '10 KM/Hr'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'description' => 'Manisha International School'],
                    ['coords' => [23.2655419, 87.8260461], 'description' => 'Narayana School'],
                    ['coords' => [23.264854, 87.826075], 'description' => 'Sri Chaitanya Techno School'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'Hospital', 'name' => 'Gouri Devi Hospital and Research Institute'],
                    ['coords' => [23.3394688, 87.6905821], 'type' => 'Pharmacy', 'name' => 'LIFE CARE PHARMACY'],
                    ['coords' => [23.266198, 87.8269029], 'type' => 'Pharmacy', 'name' => 'Artim Enterprise Pharmacy'],
                    ['coords' => [23.2533793, 87.8325407], 'type' => 'Police Station', 'name' => 'Renaissance Township Police Outpost'],
                    ['coords' => [23.1099385, 87.803194], 'type' => 'Clinic', 'name' => 'Dakshin Damodar Nursing Home'],
                ],
            ]);

            // Add SUPDT.OF POLICE,BANKURA route
            JourneyRoute::create([
                'name' => '139299 SUPDT.OF POLICE,BANKURA',
                'source' => 'Rajbandh Terminal',
                'destination' => '139299 SUPDT.OF POLICE,BANKURA',
                'start_coords' => [23.4764, 87.3975],
                'end_coords' => [23.234018, 87.060231],
                'risk_points' => [
                    ['coords' => [23.47600, 87.39865], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.47811, 87.40023], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.48581, 87.38619], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.48590, 87.38625], 'risk' => 'Blind Spot', 'speed' => '10 KM/Hr'],
                    ['coords' => [23.50385, 87.35293], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.49686, 87.32466], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.48803, 87.32008], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.48354, 87.30905], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.48346, 87.30906], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.31813, 87.22092], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.27643, 87.14436], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.26561, 87.11169], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.26203, 87.10100], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.23435, 87.07200], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.23571, 87.06716], 'risk' => 'Medium', 'speed' => '30 KM/Hr'],
                    ['coords' => [23.23506, 87.06632], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.23510, 87.06603], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.23493, 87.06594], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                    ['coords' => [23.23397, 87.06075], 'risk' => 'High', 'speed' => '15 KM/Hr'],
                ],
                'crowded_spots' => [
                    ['coords' => [23.4755227, 87.4024908], 'type' => 'school', 'name' => 'Manisha International School', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
                'emergency_locations' => [
                    ['coords' => [23.4768156, 87.4014877], 'type' => 'hospital', 'name' => 'Gouri Devi Hospital and Research Institute', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.4978896, 87.324231], 'type' => 'clinic', 'name' => 'Dreamland Nursing Home', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.4916613, 87.3181652], 'type' => 'clinic', 'name' => 'Vivek Nursing Home, Bardhaman', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.4253715, 87.2812626], 'type' => 'hospital', 'name' => 'Barjora Super Speciality Hospital', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.2483699, 87.0851174], 'type' => 'hospital', 'name' => 'Bankura Lions Eye Care Centre', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.234594, 87.064904], 'type' => 'clinic', 'name' => 'ECHS Polyclinic', 'speed' => '30 km/h', 'risk' => 'Medium'],
                    ['coords' => [23.232244, 87.063068], 'type' => 'hospital', 'name' => 'Sadar Hospital', 'speed' => '30 km/h', 'risk' => 'Medium'],
                ],
            ]);
        }
    }
}
