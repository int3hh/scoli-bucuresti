<?php

namespace App\Console\Commands;

use App\Models\School;
use App\Models\SchoolResult;
use Illuminate\Console\Command;

class CalculateRating extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'school:rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate school rating';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $schools = School::get();
        foreach ($schools as $school) {
           $results = SchoolResult::where('school_id', $school->id)->where('year', config('utils')['currentYear'])->first();
           if ($results) {
                $total_rating = 0;
                if ($school->google_rating >= 4.00) {
                    $total_rating++;
                }

                if ($results->percent_over_nine >= 80.00) {
                    $total_rating++;
                }

                if ($results->missing < 3 ) {
                    $total_rating++;
                }

                if ($results->avg > 8.50) {
                    $total_rating++;
                }

                $var = $results->var;
                if ($var < 0) {
                    $var *= -1;
                }

                if ($results->var != 0 && $results->var < 3.00) {
                    $total_rating++;
                }

                $school->total_rating = $total_rating;
                $school->save();
           }
        }
        return Command::SUCCESS;
    }
}
