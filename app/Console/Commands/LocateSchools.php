<?php

namespace App\Console\Commands;

use App\Models\School;
use Illuminate\Console\Command;

class LocateSchools extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schools:locate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs google places API to determine lat/lon for all seeded schools';

    /**
     * Execute the console command.
     *
     * @return int
     */
    const GOOGLE_URL = 'https://maps.googleapis.com/maps/api/place/findplacefromtext/json?fields=formatted_address,name,rating,opening_hours,geometry,place_id&input=%s&inputtype=textquery&key=%s';

    public function handle()
    {
       
        $schools = School::where('lat', 0)->get();
        $apiKey = config('utils')['google-api-key'];
        foreach ($schools as $school) {
            $request = sprintf(self::GOOGLE_URL, urlencode($school->name), $apiKey);
            $data = json_decode(file_get_contents($request));
            try {
                $result = $data->candidates[0];
                $school->address = $result->formatted_address;
                $school->lat = $result->geometry->location->lat;
                $school->lon = $result->geometry->location->lng;
                $school->google_rating = $result->rating ?? 0;
                $school->place_id = $result->place_id;
                $school->save();
                $this->info("Found for {$school->name}");
            } catch (\Exception $e) {
              //  dd($e);
                continue;
            }
           
        }

        return Command::SUCCESS;
    }
}
