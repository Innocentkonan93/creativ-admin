<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Praticien;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    //
    function uploadUserDoc(Request $request)
    {

        $file = $request->file('document');
        $fileName = $file->getClientOriginalName();
        $path = $file->storeAs('documents/'.$request->email_utilisateur, $fileName);

        // return response()->json(['path' => $path]);
        $document = new Document();
        $document->email_utilisateur = $request->email_utilisateur;
        $document->nom_document = $request->nom_document;
        $document->file_name = $fileName;


        $result = $document->save();

        if ($result) {
            return [
                "status" => "success",
                "data" => $document,
            ];
        } else {
            return [
                "status" => "failed",
                "data" => null,
            ];
        }
    }

    function uploadUtilisateurImage(Request $request)
    {

        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();
        $path = $file->storeAs('images/utilisateurs', $fileName);

        // return response()->json(['path' => $path]);
        $user =  Utilisateur::where('id_utilisateur', '=', $request->id_utilisateur)->firstOrFail();

        $user->id_utilisateur = $user->id_utilisateur;
        $user->nom_utilisateur = $request->nom_utilisateur;
        $user->numero_utilisateur = $request->numero_utilisateur;
        $user->age_utilisateur = $request->age_utilisateur;
        $user->taille_utilisateur = $request->taille_utilisateur;
        $user->poids_utilisateur = $request->poids_utilisateur;
        $user->gs_utilisateur = $request->gs_utilisateur;
        $user->dossier_utilisateur = $request->dossier_utilisateur;
        $user->image_utilisateur = $fileName;
        $user->pays_utilisateur = $request->pays_utilisateur;
        $user->ville_utilisateur = $request->ville_utilisateur;
        $user->adresse_utilisateur = $request->adresse_utilisateur;
        $user->status = $request->status;
        $user->pin_utilisateur = $request->pin_utilisateur;

        $result = $user->update();

        if ($result) {
            return [
                "status" => "success",
                "data" => $user,
            ];
        } else {
            return [
                "status" => "failed",
                "data" => null,
            ];
        }
    }

    function uploadPraticianImage(Request $request)
    {

        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();
        $path = $file->storeAs('images/praticiens', $fileName);

        // return response()->json(['path' => $path]);
        if ($path) {
            $praticien =  Praticien::where('id_praticien', '=', $request->id_praticien)->firstOrFail();

            $praticien->id_praticien = $praticien->id_praticien;
            $praticien->nom_praticien = $request->nom_praticien;
            $praticien->email_praticien = $request->email_praticien;
            $praticien->numero_praticien = $request->numero_praticien;
            $praticien->adresse_praticien = $request->adresse_praticien;
            $praticien->image_praticien = $fileName;
            $praticien->specialite_praticien = $request->specialite_praticien;
            $praticien->statut_praticien = $request->statut_praticien;
            $praticien->cv_praticien = $request->cv_praticien;
            $praticien->online = $request->online;
            $praticien->solde_praticien = $request->solde_praticien;

            $praticien->verif_prof = $request->verif_prof;

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
}
