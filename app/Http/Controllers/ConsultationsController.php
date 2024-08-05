<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationsController extends Controller
{
    //
    function getAllConsultations()
    {
        return Consultation::all();
    }

    function getSingleConsultation($idConsultation)
    {
        return Consultation::where('id_consultation', '=', $idConsultation)->firstOrFail();
    }

    function getAllPraticianConsultations($email_praticien)
    {
        return Consultation::where('email_praticien', '=', $email_praticien)->get();
    }

    function getAllUtilisateurConsultations($email_patient)
    {
        return Consultation::where('email_patient', '=', $email_patient)->get();
    }

    function addConsultation(Request $req)
    {
        $consultation = new Consultation();
        $consultation->id_patient = $req->id_patient;
        $consultation->email_patient = $req->email_patient;
        $consultation->id_praticien = $req->id_praticien;
        $consultation->email_praticien = $req->email_praticien;
        $consultation->statut_consultation = $req->statut_consultation;
        $consultation->ordonnance_consultation = $req->ordonnance_consultation;
        $consultation->fichier_consultation = $req->fichier_consultation;
        $consultation->id_demande = $req->id_demande;
        $consultation->prix_consultation = $req->prix_consultation;
        $consultation->is_paid = $req->is_paid;
        $consultation->date_consultation = $req->date_consultation;
        $consultation->date_modification = $req->date_modification;

        $result = $consultation->save();

        if ($result) {
            // $consultation->id_consultation = $consultation->id;
            return [
                "status" => "success",
                "data" => $consultation,
            ];
        } else {
            return [
                "status" => "failed",
                "data" => null,
            ];
        }
    }

    function updateConsultation(Request $req)
    {
        $consultation = Consultation::where('id_consultation', '=', $req->id_consultation)->firstOrFail();
        $consultation->id_patient = $req->id_patient;
        $consultation->email_patient = $req->email_patient;
        $consultation->id_praticien = $req->id_praticien;
        $consultation->email_praticien = $req->email_praticien;
        $consultation->statut_consultation = $req->statut_consultation;
        $consultation->ordonnance_consultation = $req->ordonnance_consultation;
        $consultation->is_paid = $req->is_paid;
        $consultation->statut_consultation = $req->statut_consultation;
        $consultation->fichier_consultation = $req->fichier_consultation;
        $consultation->id_demande = $req->id_demande;
        $consultation->date_modification = $req->date_modification;

        $result = $consultation->update();

        if ($result) {
            return [
                "status" => "success",
                "data" => $consultation,
            ];
        } else {
            return [
                "status" => "failed",
                "data" => null,
            ];
        }
    }
    
    function updateConsultationPaymentStatus(Request $req)
    {
        $consultation = Consultation::where('id_consultation', '=', $req->id_consultation)->firstOrFail();
        $consultation->is_paid = $req->is_paid;
        $consultation->statut_consultation = $req->statut_consultation;

        $result = $consultation->update();

        if ($result) {
            return [
                "status" => "success",
                "data" => $consultation,
            ];
        } else {
            return [
                "status" => "failed",
                "data" => null,
            ];
        }
    }
  
}
