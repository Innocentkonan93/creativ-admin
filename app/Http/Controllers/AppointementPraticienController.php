<?php

namespace App\Http\Controllers;

use App\Models\AppointementPraticien;
use Illuminate\Http\Request;

class AppointementPraticienController extends Controller
{
    //

    function allAPraticians()
    {
        return AppointementPraticien::all();
    }

    function registerAPraticien(Request $req)
    {
        $apraticien = new AppointementPraticien();
        $apraticien->id_praticien = $req->id_praticien;
        $apraticien->email_praticien = $req->email_praticien;
        // $apraticien->name_urgentiste = $req->name_urgentiste;
        // $apraticien->logo_urgentiste = $req->logo_urgentiste;
        // $apraticien->contacts = $req->contacts;
        // $apraticien->symptomes = $req->symptomes;
        // $apraticien->adresse = $req->adresse;
        // $apraticien->coordonnees = $req->coordonnees;

        $result = $apraticien->save();

        if ($result) {
            return [
                "status" => "success",
                "data" => $apraticien,
            ];
        } else {
            return [
                "status" => "failed",
                "data" => null,
            ];
        }
    }

    function updateAPraticien(Request $req)
    {

        $apraticien = AppointementPraticien::where('id_praticien', '=', $req->id_praticien)->firstOrFail();
        $apraticien->id_praticien = $req->id_praticien;
        $apraticien->nom_praticien = $req->nom_praticien;
        $apraticien->email_praticien = $req->email_praticien;
        $apraticien->numero_praticien = $req->numero_praticien;
        $apraticien->image_praticien = $req->image_praticien;
        $apraticien->description_praticien = $req->description_praticien;
        $apraticien->specialite_praticien = $req->specialite_praticien;
        $apraticien->adresse_praticien = $req->adresse_praticien;
        $apraticien->statut_praticien = $req->statut_praticien;
        $apraticien->cv_praticien = $req->cv_praticien;
        $apraticien->solde_praticien = $req->solde_praticien;
        $apraticien->is_online = $req->is_online;
        $apraticien->is_verify = $req->is_verify;
        $result = $apraticien->update();

        if ($result) {
            // $consultation->id_consultation = $consultation->id;
            return [
                "status" => "success",
                "data" => $apraticien,
            ];
        } else {
            return [
                "status" => "failed",
                "data" => null,
            ];
        }
    }

    function getSingleAPraticien($idPraticien)
    {
        return AppointementPraticien::where('id_praticien', '=', $idPraticien)->firstOrFail();
    }

    function updateAppointPraticianSolde(Request $request)
    {
        $praticien =  AppointementPraticien::where('id_praticien', '=', $request->id_praticien)->firstOrFail();

        $amount = (int) $request->amount;
        $solde = (int) $praticien->solde_praticien;
        $sum = $solde + $amount;
        $praticien->solde_praticien = strval($sum);
        $result = $praticien->update();

        if ($result) {
            return [
                "status" => "success",
                "data" => $praticien,
            ];
        } else {
            return [
                "status" => "failed",
                "data" => null,
            ];
        }
    }
}
