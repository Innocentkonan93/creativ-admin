<?php

namespace App\Http\Controllers;

use App\Models\ActivitesPraticien;
use Illuminate\Http\Request;

class ActivitesPraticienController extends Controller
{
    //

    function getAllPraticiensActivites()
    {
        return ActivitesPraticien::all();
    }

    function createActivity(Request $req){
        $activity = new ActivitesPraticien();
        $activity->activite = $req->activite;
        $activity->nom_praticien = $req->nom_praticien;
        $activity->specialite_praticien = $req->specialite_praticien;
        $activity->email_patient = $req->email_patient;
        $activity->email_praticien = $req->email_praticien;
        $activity->nom_document = $req->nom_document;
        $activity->file_name = $req->file_name;
        $activity->date_activite = $req->date_activite; 

        $result = $activity->save();

        if ($result) {
            return [
                "status" => "success",
                "data" => $activity,
            ];
        } else {
            return [
                "status" => "failed",
                "data" => null,
            ];
        }
    }

}
