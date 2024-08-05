<?php

namespace App\Http\Controllers;

use App\Models\Urgence;
use Illuminate\Http\Request;

class UrgenceController extends Controller
{
    //
    function allUrgences(){
        return Urgence::all();
    }

    function registerUrgence(Request $req){
        $urgence = new Urgence();
        $urgence->id_urgentiste = $req->id_urgentiste;
        $urgence->email_urgentiste = $req->email_urgentiste;
        // $urgence->name_urgentiste = $req->name_urgentiste;
        // $urgence->logo_urgentiste = $req->logo_urgentiste;
        // $urgence->contacts = $req->contacts;
        // $urgence->symptomes = $req->symptomes;
        // $urgence->adresse = $req->adresse;
        // $urgence->coordonnees = $req->coordonnees;

        $result = $urgence->save();

        if ($result) {
            // $consultation->id_consultation = $consultation->id;
            return [
                "status" => "success",
                "data" => $urgence,
            ];
        } else {
            return [
                "status" => "failed",
                "data" => null,
            ];
        }
    }

    function updateUrgence(Request $req){
        
        $urgence =   Urgence::where('id_urgentiste', '=', $req->id_urgentiste)->firstOrFail();
        $urgence->id_urgentiste = $req->id_urgentiste;
        $urgence->email_urgentiste = $req->email_urgentiste;
        $urgence->name_urgentiste = $req->name_urgentiste;
        $urgence->logo_urgentiste = $req->logo_urgentiste;
        $urgence->contacts = $req->contacts;
        $urgence->adresse = $req->adresse;
        $urgence->status = $req->status;
        $urgence->coordonnees = $req->coordonnees;

        $result = $urgence->update();

        if ($result) {
            // $consultation->id_consultation = $consultation->id;
            return [
                "status" => "success",
                "data" => $urgence,
            ];
        } else {
            return [
                "status" => "failed",
                "data" => null,
            ];
        }
    }


    function getSingleUrgence($idUrgentiste)
    {
        return Urgence::where('id_urgentiste', '=', $idUrgentiste)->firstOrFail();
    }
}
