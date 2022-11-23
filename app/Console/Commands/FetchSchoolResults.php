<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use App\Models\School;
use App\Models\SchoolResult;

class RawSchoolResult {
    private $year;
    private $candidates;
    private $missing;
    private $avgSum;
    private $plus9;
    private $menId;

    public function __construct($year, $menId)
    {
        $this->year = $year;
        $this->menId = $menId;
        $this->plus9 = 0;
        $this->missing = 0;
        $this->candidates = 0;
    }

    function addNewResult($result) {
        if ($result->mev > 0) {
            $this->candidates++;
            $this->avgSum += $result->mev;
            if ($result->mev >= 9.00) {
                $this->plus9++;
            } 
        } else {
            $this->missing++;
        }
    }

    function serializeIntoResult($year) {
        $school = School::where('men_id', $this->menId)->first();
        if ($school == null) {
            throw new \Exception("Invalid school, please repull schools");
        }

        $var = 0;
        $avg = ($this->avgSum > 0) ?  $this->avgSum / $this->candidates : 0;
        $avg = round($avg, 2);
        $lastYear = SchoolResult::where('year',  $year - 1)->where('school_id', $school->id)->first();
        if ($lastYear && $lastYear->avg > 0) {
            $var = (($avg - $lastYear->avg) / $lastYear->avg) * 100;
        }

        return [
            'year' => $this->year,
            'school_id' => $school->id,
            'students' => $this->candidates,
            'avg' => $avg,
            'over_nine' => $this->plus9,
            'percent_over_nine' => ($this->plus9 == 0) ? 0 : ($this->plus9 / $this->candidates) * 100,
            'missing' => $this->missing,
            'var' => $var,
        ];
    }
}

class FetchSchoolResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'school:results {year}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all school results on a certain year';

    /**
     * Execute the console command.
     *
     * @return int
     */
    const RESULTS_URL = "http://evaluare.edu.ro/%s/rezultate/B/data/candidate.json?_=%s";

    public function handle()
    {

        $request = sprintf(self::RESULTS_URL, $this->argument('year'), time());
        try {
            $data = json_decode(file_get_contents($request));
            $results = [];
            foreach ($data as $result) {
                if (!isset($results[$result->schoolCode])) {
                    $results[$result->schoolCode] = new RawSchoolResult((int) $this->argument('year'), $result->schoolCode);
                }
                $results[$result->schoolCode]->addNewResult($result);
            }
        } catch (\Exception $e)
        {
            $this->error("Failed to get data for selected year!");
            dd($e);
            return Command::FAILURE;
        }

        foreach($results as $result) {
            SchoolResult::create($result->serializeIntoResult((int) $this->argument('year')));
        }

        return Command::SUCCESS;
    }
}
