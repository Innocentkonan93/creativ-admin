<?php

namespace App\Http\Controllers;

use App\Models\Praticien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PraticiensController extends Controller
{
    //

    //
    function loginPraticien(Request $request)
    {
        $praticien = Praticien::where('email_praticien', $request->email_praticien)->first();
        // print_r($data);
        if (!$praticien || !Hash::check($request->mdp_praticien, $praticien->mdp_praticien)) {

            if (!$praticien || $request->mdp_praticien !=  $praticien->mdp_praticien) {
                return response([
                    'status' => 'failed',
                    'data' => null,
                    'message' => 'These credentials do not match our records.'
                ], 404);
            }
        }
        $praticien->save();
        // $token = $praticien->createToken('my-app-token',)->plainTextToken;
        $response = [
            'data' => $praticien,
            // 'token' => $token
        ];

        return response($response, 200);
    }

    function getAllPraticiens()
    {
        return Praticien::where('verif_prof', '=', 'oui')->get();
    }

    function getSinglePraticien($id_praticien)
    {
        return Praticien::where('id_praticien', '=', $id_praticien)->firstOrFail();
    }

    function getCurrentPraticien($email_praticien)
    {
        return Praticien::where('email_praticien', '=', $email_praticien)->firstOrFail();
    }


    function updatePraticien(Request $request)
    {
        $praticien =  Praticien::where('id_praticien', '=', $request->id_praticien)->firstOrFail();

        $praticien->id_praticien = $praticien->id_praticien;
        $praticien->nom_praticien = $request->nom_praticien;
        $praticien->email_praticien = $request->email_praticien;
        $praticien->numero_praticien = $request->numero_praticien;
        $praticien->adresse_praticien = $request->adresse_praticien;
        $praticien->image_praticien = $request->image_praticien;
        $praticien->signature_praticien = $request->signature_praticien;
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

    function updatePraticianPassword(Request $request)
    {
        $praticien =  Praticien::where('id_praticien', '=', $request->id_praticien)->firstOrFail();

        $praticien->mdp_praticien = bcrypt($request->mdp_praticien);

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

    function updatePraticianSolde(Request $request)
    {
        $praticien =  Praticien::where('id_praticien', '=', $request->id_praticien)->firstOrFail();

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



    function getPassword()
    {
        return [
            "status" => "success",
            "data" => bcrypt("123456"),
        ];
    }
}
