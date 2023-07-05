<?php

namespace App\Console\Commands;

use App\Models\School;
use Illuminate\Console\Command;

class AddMissing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schools:missing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Missing schools';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $missing = [
            [
                'name' => 'Liceul Teoretic Atlas',
                'google_rating' => 4.4,
                'address' => 'Bvd.Timisoara 60D',
                'phoneNo' => '0214400708',
                'email' => 'secretariat@scoalaatlas.ro',
                'number' => 0,
                'lat' => '44.4251344',
                'lon' => '26.0102531',
                'men_id' => '4061205541',
                'sector' => 6,
                'privat' => 1,
                'nivel' => 6,
                'total_rating' => 3,
                'place_id' => 'Școala+Atlas+-+Liceu.+Postliceală.',
            ],
        ];

        foreach ($missing as $miss) {
            School::create($miss);
        }
    }
}
