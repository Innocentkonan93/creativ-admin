<?php

namespace App\Http\Controllers;

use App\Models\DepartementService;
use Illuminate\Http\Request;

class DepartementServiceController extends Controller
{
    //

    function getAllDepartementService(){
        return DepartementService::all();
    }

    function getSingleDepartementService($id_departement_service){
        return DepartementService::where('id_departement_service', '=', $id_departement_service)->firstOrFail();
    }
}
