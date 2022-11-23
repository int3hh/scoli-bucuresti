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

}
