<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DemandesController extends Controller
{
    //
    function getAllDemandes()
    {
        return Demande::all();
    }

    function getAllNewDemandes()
    {
        return Demande::where('status_demande', '=', 'CREATED')->get();
    }

    function getSingleDemande($id_demande)
    {
        return Demande::where('id_demande', '=', $id_demande)->firstOrFail();
    }

    function createNewDemande(Request $request)
    {

        $time = new \DateTime();

        $uniqid = Str::random(11);

        $newDemande = new Demande();
        $newDemande->id_demande = $uniqid;
        $newDemande->type_demande = $request->type_demande;
        $newDemande->description = $request->description;
        $newDemande->departement_service = $request->departement_service;
        $newDemande->id_utilisateur = $request->id_utilisateur;
        $newDemande->email_utilisateur = $request->email_utilisateur;
        $newDemande->tarif_demande = $request->tarif_demande;
        $newDemande->status_demande = $request->status_demande;
        $newDemande->id_praticien = $request->id_praticien;
        $newDemande->email_praticien = $request->email_praticien;
        $newDemande->date_demande = $request->date_demande;

        $newDemande->fichier_demande = $request->fichier_demande;
        $result =  $newDemande->save();

        if ($result) {
            return [
                "status" => "success",
                "data" => $newDemande,
            ];
        } else {
            return [
                "status" => "failed",
                "data" => null,
            ];
        }
    }

    function createNewDemandeWithFile(Request $request)
    {

        $time = new \DateTime();

        $uniqid = Str::random(11);

        $newDemande = new Demande();
        $newDemande->id_demande = $uniqid;
        $newDemande->type_demande = $request->type_demande;
        $newDemande->description = $request->description;
        $newDemande->departement_service = $request->departement_service;
        $newDemande->id_utilisateur = $request->id_utilisateur;
        $newDemande->email_utilisateur = $request->email_utilisateur;
        $newDemande->tarif_demande = $request->tarif_demande;
        $newDemande->status_demande = $request->status_demande;
        $newDemande->id_praticien = $request->id_praticien;
        $newDemande->email_praticien = $request->email_praticien;
        $newDemande->date_demande = $request->date_demande;

        // $newDemande->fichier_demande = $request->fichier_demande;

        $file = $request->file('fichier');
        $fileName = $file->getClientOriginalName();
        $path = $file->storeAs('interpretations', $fileName);

        $newDemande->fichier_demande = $fileName;

        $result =  $newDemande->save();
        if ($result) {
            return [
                "status" => "success",
                "data" => $newDemande,
            ];
        } else {
            return [
                "status" => "failed",
                "data" => [],
            ];
        }
    }

    function updateDemande(Request $request)
    {
        $demande =  Demande::where('id_demande', '=', $request->id_demande)->firstOrFail();

        $demande->type_demande = $request->type_demande;
        $demande->description = $request->description;
        $demande->departement_service = $request->departement_service;
        $demande->id_utilisateur = $request->id_utilisateur;
        $demande->email_utilisateur = $request->email_utilisateur;
        $demande->status_demande = $request->status_demande;
        $demande->id_praticien = $request->id_praticien;
        $demande->email_praticien = $request->email_praticien;
        $demande->tarif_demande = $request->tarif_demande;
        $demande->fichier_demande = $request->fichier_demande;
        $demande->date_demande = $request->date_demande;

        $result = $demande->update();

        $response = [
            'status' => 'update',
            'data' => $demande,
        ];

        if (!$result) {
            return response([
                'status' => 'failed',
                'data' => null
            ], 404,);
        }

        return response($response, 200);
    }

    function getAllPraticianDemandes($email_praticien)
    {
        return Demande::where('email_praticien', '=', $email_praticien)->get();
    }

    function getAllUtilisateurDemandes($email_utilisateur)
    {
        return Demande::where('email_utilisateur', '=', $email_utilisateur)->get();
    }

    function cancelDemande(Request $request)
    {
        $demande =  Demande::where('id_demande', '=', $request->id_demande)->firstOrFail();
 
        $demande->status_demande = "CANCELED";
        $result = $demande->update();

        $response = [
            'status' => 'update',
            'data' => $demande,
        ];

        if (!$result) {
            return response([
                'status' => 'failed',
                'data' => null
            ], 404,);
        }

        return response($response, 200);
    }
}
