<?php

namespace App\Console\Commands;

use App\Http\Classes\MenScraper;
use App\Models\School;
use Illuminate\Console\Command;

class FetchSchoolDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'school:details {judet}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches the school details';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $scraper = new MenScraper($this->argument('judet'));
        $pairs = [];
        while (($data = $scraper->get()) !== false) {
            foreach ($data as $school) {
                $pairs[$school->CODE] = strval($school->ID_SCHOOL);
            }
        }

        $schools = School::all();
        foreach ($schools as $school) {
            try {
                $this->info("Extracting details for {$school->name}");
                $schoolId = $pairs[$school->men_id]; 
                $details = json_decode(file_get_contents(sprintf("https://siiir.edu.ro/carto/app/rest/school/details/%s", $schoolId)));
               // $school->email = $details->email;
               //  $school->phoneNo = $details->phoneNumber;
                $schooling = json_decode(file_get_contents(sprintf("https://siiir.edu.ro/carto/app/rest/school/organisation/%s", $schoolId)));
                $nivel = 0;
                foreach ($schooling->schoolLevels as $key => $level) {
                    $lvl = 0;
                    if (strpos($level->level, 'Primar') !== false) {
                       $lvl = School::NIVEL_PRIMAR;
                    } else if (strpos($level->level, 'Gimnazi') !== false) {
                       $lvl = School::NIVEL_GIMNAZIAL;
                    } else if (strpos($level->level, 'Lice') !== false) {
                       $lvl = School::NIVEL_LICEAL;
                    }

                    if ($lvl && ( ($lvl & $nivel) != $lvl)) {
                        $nivel |= $lvl;
                    } 
              
                }    
                $this->info("Nivel $nivel...\n");
                $school->nivel = $nivel;
                // $school->privat = strpos($details->fundingForm, 'Tax') !== false;
                $school->save();          
            } catch (\Exception $e) {
                dd($e->getMessage());
                continue;
            }
        }
        return Command::SUCCESS;
    }
}
