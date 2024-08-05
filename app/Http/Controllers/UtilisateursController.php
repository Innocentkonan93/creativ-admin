<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UtilisateursController extends Controller
{
    //
    function login(Request $request)
    {
        $user = Utilisateur::where('email_utilisateur', $request->email_utilisateur)->first();
        // print_r($data);
        if (!$user || !Hash::check($request->mdp_utilisateur, $user->mdp_utilisateur)) {

            if (!$user || $request->mdp_utilisateur !=  $user->mdp_utilisateur) {
                return response([
                    'status' => 'failed',
                    'data' => null,
                    'message' => 'These credentials do not match our records.'
                ], 404);
            }
        }
        $user->save();
        // $token = $user->createToken('my-app-token',)->plainTextToken;
        $response = [
            'data' => $user,
            // 'token' => $token
        ];

        return response($response, 200);
    }

    function register(Request $request)
    {
        $user = new Utilisateur();

        $user->nom_utilisateur = $request->nom_utilisateur;
        $user->email_utilisateur = $request->email_utilisateur;
        $user->numero_utilisateur = $request->numero_utilisateur;
        $user->mdp_utilisateur = bcrypt($request->mdp_utilisateur);
        $user->age_utilisateur = $request->age_utilisateur;
        $user->taille_utilisateur = $request->taille_utilisateur;
        $user->poids_utilisateur = $request->poids_utilisateur;
        $user->gs_utilisateur = $request->gs_utilisateur;
        $user->image_utilisateur = $request->image_utilisateur;
        $user->pays_utilisateur = $request->pays_utilisateur;
        $user->ville_utilisateur = $request->ville_utilisateur;
        $user->adresse_utilisateur = $request->adresse_utilisateur;
        $user->status = $request->status;
        $user->pin_utilisateur = $request->pin_utilisateur;

        $user->save();

        $response = [
            'status' => 'created',
            'data' => $user
        ];

        return response($response, 200);
    }

    function update(Request $request)
    {
        $user =  Utilisateur::where('id_utilisateur', '=', $request->id_utilisateur)->firstOrFail();

        $user->id_utilisateur = $user->id_utilisateur;
        $user->nom_utilisateur = $request->nom_utilisateur;
        $user->numero_utilisateur = $request->numero_utilisateur;
        $user->age_utilisateur = $request->age_utilisateur;
        $user->taille_utilisateur = $request->taille_utilisateur;
        $user->poids_utilisateur = $request->poids_utilisateur;
        $user->gs_utilisateur = $request->gs_utilisateur;
        $user->dossier_utilisateur = $request->dossier_utilisateur;
        $user->image_utilisateur = $request->image_utilisateur;
        $user->pays_utilisateur = $request->pays_utilisateur;
        $user->ville_utilisateur = $request->ville_utilisateur;
        $user->adresse_utilisateur = $request->adresse_utilisateur;
        $user->status = $request->status;
        $user->pin_utilisateur = $request->pin_utilisateur;

        $result = $user->update();

        $response = [
            'status' => 'update',
            'data' => $user
        ];

        if (!$result) {
            return response([
                'status' => 'failed',
                'data' => null
            ], 404);
        }

        return response($response, 200);
    }

    function updatePassword(Request $request)
    {
        $utilisateur =  Utilisateur::where('id_utilisateur', '=', $request->id_utilisateur)->firstOrFail();


        $utilisateur->mdp_utilisateur = bcrypt($request->mdp_utilisateur);

        $result = $utilisateur->update();

        if ($result) {
            return [
                "status" => "success",
                "data" => $utilisateur,
            ];
        } else {
            return [
                "status" => "failed",
                "data" => null,
            ];
        }
    }

    function allUtilisateurs()
    {
        return Utilisateur::all();
    }

    function singleUtilisateur($id_utilisateur)
    {
        return Utilisateur::where('id_utilisateur', '=', $id_utilisateur)->firstOrFail();
    }

    function singlePatient($email_utilisateur)
    {
        return Utilisateur::where('email_utilisateur', '=', $email_utilisateur)->firstOrFail();
    }

    function sendResetPasswordMail(Request $request)
    {



        $subject = $request->subject;
        $email_utilisateur = $request->email_utilisateur;

        $utilisateur =  Utilisateur::where('email_utilisateur', '=', $request->email_utilisateur)->first();

        $body = '
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Successfull Registration</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <table cellpadding="0" cellspacing="0" width="100%" style="height: 100vh;">
        <tbody><tr>
        <td style="padding: 10px 10px 8px 5px; background-color: rgba(128, 128, 128, 0.209);" align="center">
        <img style="display: block;" width="auto" height="100px" src="https://creativ-group.com/images/logos/allodoc/logo.png" alt="Allodocteurplus logo">
        </td>
        </tr>
        <tr>
        <td style="padding: 10px 10px 10px 10px;">
            <table  cellpadding="0" cellspacing="0" width="100%">
                <tbody><tr>
                <td align="center">
                    <img style="display: block; margin: 20px 0px;" width="auto" height="100px" src="https://allodocteurplus.com/Images/online-status.png" alt="Allodocteurplus logo">
                </td>
                </tr>
                <tr>
                <td>
                <p style="text-align: center; font-size: 19px">
                Votre demande de récupération de mot de passe à été validée,<br> cliquez sur continuer pour créer un nouveau mot de passe.
                </p>
                </td>
                </tr>
                <tr>
                <td>
                <center>
                    <button style="background-color: #00A7FF; border: none; padding: 10px 25px; font-size: 15px; font-weight: 400; color: #FFF; margin: 50px 0px;"><a style="color: white;" href="https://creativ-group.com/forgot/allodoc/setpassword.php?u= ' . $email_utilisateur . '  ">Continuer</a></button>
                </center>
                </td>
                </tr>
            </tbody></table>
        </td>
        </tr>
        <tr>
        <td  style="padding: 10px 10px 10px 10px; background-color: rgba(128, 128, 128, 0.209);">
        </td>
        </tr>
        </tbody></table>
        ';

        if (isset($utilisateur)) {
            // $send = Mail::raw($body, function ($message) use ($subject, $email_utilisateur) {
            // $message->to($email_utilisateur)
            //     ->subject($subject);
            // });

            $send = Mail::send([], [], function ($message) use ($body, $subject, $email_utilisateur) {
                $message
                    ->from(' support@allodocteurplus.com')
                    ->to($email_utilisateur)
                    ->subject($subject)
                    ->html($body)
                    ->text('Plain Text');
            });

            if ($send) {
                return [
                    "success" => true,
                    "message" => "Un mail de récupération vous à été envoyé."
                ];
            } else {
                return [
                    "success" => false,
                    "message" => "Une erreur s'est produite, veuillez rééssayer."
                ];
            }
        } else {
            return [
                "success" => false,
                "message" => "Utilisateur introuvable.",
            ];
        }
    }
}
