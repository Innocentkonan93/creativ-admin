<?php

namespace App\Http\Controllers;

use App\Models\NotesConsultation;
use Illuminate\Http\Request;

class NotesConsultationController extends Controller
{
    //

    function addConsultationRate(Request $req)
    {
        $note = new NotesConsultation();
        $note->id_consultation = $req->id_consultation; 
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

    function updateConsultationRate(Request $req)
    {

        $note = NotesConsultation::where('id', '=', $req->id)->firstOrFail();
        $note->id_consultation = $req->id_consultation; 
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
}
