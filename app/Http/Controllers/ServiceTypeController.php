<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    //

    function getAllServiceTypes()
    {
        return ServiceType::all();
    }
}
