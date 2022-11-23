<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\School;

class SchoolResult extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function school() {
        return $this->belongsTo(School::class);
    }

    public function fluctuation() {
        $lastYear = SchoolResult::where('year', config('utils')['currentYear'] - 1)->first();
        if ($lastYear) {
            $diff = (($this->avg - $lastYear->avg) / $lastYear->avg) * 100;
            return $diff;
        }

        return 0;
    }
}
