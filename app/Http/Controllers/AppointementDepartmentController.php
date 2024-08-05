<?php

namespace App\Http\Controllers;

use App\Models\AppointementDepartment;
use Illuminate\Http\Request;

class AppointementDepartmentController extends Controller
{
    //

    function getAllAppointementDepartments(){
        return AppointementDepartment::all();
    }
}
