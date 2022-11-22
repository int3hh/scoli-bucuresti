<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = file_get_contents('http://evaluare.edu.ro/2022/rezultate/B/data/school.json?_=1669121637616');
        $schools = json_decode($data);
        foreach ($schools as $school) {
            $name = trim($school->name);
            if (preg_match("/[\„\”|(,,)]/", $name) === 1) {
                $name = iconv('UTF-8', 'ASCII//TRANSLIT', $name);
                $name = str_replace(',,', '"', $name);
            }

            DB::table('schools')->insertOrIgnore([
                'men_id' => $school->code,
                'name' => $name,
                'phoneNo' => $school->phone,
            ]);
        }
    }
}
