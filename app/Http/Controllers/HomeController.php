<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\SchoolResult;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('dashboard');
    }

    public function lista() {
        return view('lista');
    }

    public function despre() {
        return view('dashboard');
    }

    public function test() {
        $rez = SchoolResult::where('id', 1)->first();
        dd($rez->school->name);
    }
}
