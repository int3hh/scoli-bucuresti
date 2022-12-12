<?php

namespace App\Console\Commands;

use App\Models\School;
use Illuminate\Console\Command;
use App\Http\Classes\MenScraper;

class FetchAllSchools extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schools:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches all schools from MEN SIIR portal.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $scraper = new MenScraper();
        while (($data = $scraper->get()) !== false) {
            foreach ($data as $school) {
                $sch = School::where('men_id', $school->CODE)->first();
                if ($sch) {
                    try {
                        $sector = (int) substr($school->LOCALITY, -1);
                        if (is_numeric($sector)) {
                            $sch->sector = $sector;
                            $sch->save();
                        }
                    } catch (\Exception $e) {
                        continue;
                    }
                } else {
                    if (strpos($school->NAME, 'coala') !== false  || strpos($school->NAME, 'Colegiu') !== false) {
                        $this->info("Candidate {$school->NAME}");
                        $details = file_get_contents(sprintf("https://siiir.edu.ro/carto/app/rest/school/organisation/%s", $school->ID_SCHOOL));
                        $details = json_decode($details);
                        $primary = false;
                        foreach ($details->schoolLevels as $level) {
                            if ($level->level == 'Primar') {
                                $primary = true;
                            }
                        }
                        if (!$primary) {
                            continue;
                        }
                        try {
                            $sector = (int) substr($school->LOCALITY, -1);
                        } catch (\Exception) {

                        }
                        $this->info("Inserting ", $school->NAME);
                        School::create([
                            'name' => $school->NAME,
                            'men_id' => $school->CODE,
                            'sector' => $sector,
                            'total_rating' => 0,
                        ]);
                    }
                }
            }
            
        }
        
        return Command::SUCCESS;
    }
}
