<?php

namespace App\Http\Controllers;

use App\Models\NotesPraticien;
use Illuminate\Http\Request;

class NotesPraticienController extends Controller
{
    //
    function addPraticienRate(Request $req)
    {
        $note = new NotesPraticien();
        $note->id_praticien = $req->id_praticien; 
        $note->note = $req->note;
        $note->observation = $req->observation;
        $note->id_utilisateur = $req->id_utilisateur;

        $result = $note->save();

        if ($result) {
            // $consultation->id_consultation = $consultation->id;
            return [
                "status" => "success",
                "data" => $note,
            ];
        } else {
            return [
                "status" => "failed",
                "data" => null,
            ];
        }
    }

    function updatePraticienRate(Request $req)
    {

        $note = NotesPraticien::where('id', '=', $req->id)->firstOrFail();
        $note->id_praticien = $req->id_praticien; 
        $note->note = $req->note;
        $note->observation = $req->observation;
        $note->id_utilisateur = $req->id_utilisateur;

        $result = $note->update();

        if ($result) {
            // $consultation->id_consultation = $consultation->id;
            return [
                "status" => "success",
                "data" => $note,
            ];
        } else {
            return [
                "status" => "failed",
                "data" => null,
            ];
        }
    }


    function getAllPraticienRates($idPraticien)
    {
        return NotesPraticien::where('id_praticien', '=', $idPraticien)->get();
    }
}
