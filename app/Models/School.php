<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;


    protected $guarded = ['id'];

    const NIVEL_PRIMAR = 1 << 0;
    const NIVEL_GIMNAZIAL = 1 << 1;
    const NIVEL_LICEAL = 1 << 2;

    const Nivele = [
        self::NIVEL_PRIMAR,
        self::NIVEL_GIMNAZIAL,
        self::NIVEL_LICEAL,
    ];

    public function hasResults() : bool {
        return ( SchoolResult::where('year', config('utils')['currentYear'])->where('school_id', $this->id)->first() != NULL );
    }
}
