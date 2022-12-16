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

        $schools = School::where('email', null)->get();
        foreach ($schools as $school) {
            try {
                $this->info("Extracting details for {$school->name}");
                $schoolId = $pairs[$school->men_id]; 
                $details = json_decode(file_get_contents(sprintf("https://siiir.edu.ro/carto/app/rest/school/details/%s", $schoolId)));
                $school->email = $details->email;
                $school->phoneNo = $details->phoneNumber;
                $schooling = json_decode(file_get_contents(sprintf("https://siiir.edu.ro/carto/app/rest/school/organisation/%s", $schoolId)));
                $nivel = 0;
                foreach ($schooling->schoolLevels as $key => $level) {
                    if (strpos($level->level, 'Primar') !== false) {
                        if ($nivel == 0) {
                            $nivel = 1;
                        }
                    } else if (strpos($level->level, 'Gimnazi') !== false) {
                        if ($nivel <= 1) {
                            $nivel = 2;
                        }
                    } else if (strpos($level->level, 'Lice') !== false) {
                        $nivel = 3;
                    }
                }    
                $school->nivel = $nivel;
                $school->privat = strpos($details->fundingForm, 'Tax') !== false;
                $school->save();          
            } catch (\Exception $e) {
                dd($e->getMessage());
                continue;
            }
        }
        return Command::SUCCESS;
    }
}
