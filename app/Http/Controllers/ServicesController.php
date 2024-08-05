<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    //
    function getAllServices(){
        return Service::all();
    }
}
