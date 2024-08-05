<?php

namespace App\Http\Controllers;

use App\Models\Desease;
use Illuminate\Http\Request;

class DeseaseController extends Controller
{
    //

    function registerDesease(Request $req)
    {
        $desease = new Desease();
        $desease->id_urgence = $req->id_urgence;
        $desease->deseases = $req->deseases;
        $desease->symptoms = $req->symptoms;

        $result = $desease->save();

        if ($result) {
            // $consultation->id_consultation = $consultation->id;
            return [
                "status" => "success",
                "data" => $desease,
            ];
        } else {
            return [
                "status" => "failed",
                "data" => null,
            ];
        }
    }

    function updateDesease(Request $req)
    {
        $desease = Desease::where('id', '=', $req->id)->firstOrFail();
        $desease->id_urgence = $req->id_urgence;
        $desease->deseases = $req->deseases;
        $desease->symptoms = $req->symptoms;
        
        $result = $desease->update();

        if ($result) {
            // $consultation->id_consultation = $consultation->id;
            return [
                "status" => "success",
                "data" => $desease,
            ];
        } else {
            return [
                "status" => "failed",
                "data" => null,
            ];
        }
    }


    function getAllUrgenceDeseases($idUrgence)
    {
        return Desease::where('id_urgence', '=', $idUrgence)->get();
    }

    function getAllDeseases()
    {
        return Desease::all();
    }
}
