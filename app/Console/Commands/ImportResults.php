<?php

namespace App\Console\Commands;

use App\Models\School;
use App\Models\SchoolResult;
use Illuminate\Console\Command;

class ImportResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'results:import {year} {judet}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports results for a certain year and district';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $year = $this->argument('year');
        $judet = $this->argument('judet');

        $this->info("Importing {$judet} for year {$year} ...");

        $schools = School::all()->keyBy('men_id');

        try {
            $f = fopen(storage_path(sprintf("results/%s/%s.csv", $year, $judet)), 'r');
            while (($line = fgetcsv($f)) !== FALSE) {

                $avg = (float) $line[3] / (float) $line[1];
                $lastYear = SchoolResult::where('year',  $year - 1)->where('school_id', $schools[$line[0]]->id)->first();
                if ($lastYear && $lastYear->avg > 0) {
                    $var = (($avg - $lastYear->avg) / $lastYear->avg) * 100;
                }
          
                SchoolResult::create([
                    'year' => $year,
                    'school_id' => $schools[$line[0]]->id,
                    'students' => (int) $line[1] + (int) $line[2],
                    'avg' => $avg,
                    'over_nine' => $line[4],
                    'percent_over_nine' => ((int) $line[4] / ( (int) $line[1] + (int) $line[2] )) * 100,
                    'var' => $var,
                    'missing' => $line[2],
                ]);              
                
            }

        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        
        
    }
}
