<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;


    protected $guarded = ['id'];

    public function hasResults() : bool {
        return ( SchoolResult::where('year', config('utils')['currentYear'])->where('school_id', $this->id)->first() != NULL );
    }
}
