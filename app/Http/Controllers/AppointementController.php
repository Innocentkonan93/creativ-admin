<?php

namespace App\Http\Controllers;

use App\Models\Appointement;
use Illuminate\Http\Request;

class AppointementController extends Controller
{
    //

    function registerAppointement(Request $req){

        $appointement = new Appointement();
        $appointement->id_patient = $req->id_patient;
        $appointement->nom_patient = $req->nom_patient;
        $appointement->specialite = $req->specialite;
        $appointement->id_praticien = $req->id_praticien;
        $appointement->prix= $req->prix;
        $appointement->status = $req->status;
        $appointement->date = $req->date;

        $result = $appointement->save();

        if ($result) {
            return [
                "status" => "success",
                "data" => $appointement,
            ];
        } else {
            return [
                "status" => "failed",
                "data" => null,
            ];
        }
    }

    function updateAppointement(Request $req){

        $appointement =  Appointement::where('id', '=', $req->id);
        $appointement->id_patient = $req->id_patient;
        $appointement->nom_patient = $req->nom_patient;
        $appointement->specialite = $req->specialite;
        $appointement->id_praticien = $req->id_praticien;
        $appointement->prix= $req->prix;
        $appointement->status = $req->status;
        $appointement->date = $req->date;

        $result = $appointement->update();

        if ($result) {
            return [
                "status" => "success",
                "data" => $appointement,
            ];
        } else {
            return [
                "status" => "failed",
                "data" => null,
            ];
        }
    }

    function getAllAppointements(){
        return Appointement::all();
    }

    function getAllPraticianAppointements($idPraticians){
        return  Appointement::where('id_praticien', '=', $idPraticians)->get();
    }

    function getAllUtilisateurAppointements($idPatient){
        return  Appointement::where('id_patient', '=', $idPatient)->get();
    }
}
