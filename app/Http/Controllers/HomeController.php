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

    public function rezultate() {
        return view('rezultate');
    }

    public function despre() {
        return view('dashboard');
    }

    public function test() {
        dd(round(0, 2));
   }
}
