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

    protected $judete = ['IF', 'B'];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        foreach ($this->judete as $judet) {
            if ($judet == 'B') {
                continue;
            }
            $scraper = new MenScraper($judet);
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
                       //  $this->info($school->NAME);
                        if (strpos(strtolower($school->NAME), 'coala') !== false  || strpos(strtolower($school->NAME), 'colegiu') !== false) {
                            $this->info("Candidate {$school->NAME}");
                            $details = file_get_contents(sprintf("https://siiir.edu.ro/carto/app/rest/school/organisation/%s", $school->ID_SCHOOL));
                            $details = json_decode($details);
                            $primary = false;
                            foreach ($details->schoolLevels as $level) {
                                if ($level->level == 'Primar') {
                                    $primary = true;
                                }
                            }
                            
                            if ((!$primary) && (strpos(strtolower($school->NAME), 'coala') === false)) {
                                continue;
                            }
                            $sector = 0;
                            try {
                                if ($judet == 'B') {
                                    $sector = (int) substr($school->LOCALITY, -1);
                                } 
                            } catch (\Exception $e) {
                                dd($e);
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
        }
        return Command::SUCCESS;
    }
}
