<?php

namespace App\Http\Controllers;

use App\Models\Pharmacie;
use Illuminate\Http\Request;

class PharmaciesController extends Controller
{
    //
    function getAllPharmacies()
    {
        return Pharmacie::all();
    }

    function getSinglePharmacie($id_pharmacie)
    {
        return Pharmacie::where('id_pharmacie', '=', $id_pharmacie)->firstOrFail();
    }
}
