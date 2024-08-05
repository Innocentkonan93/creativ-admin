<?php

namespace App\Http\Controllers;

use App\Models\Signature;
use Illuminate\Http\Request;

class SignatureController extends Controller
{
    //
    function getAllSignatures()
    {
        return Signature::all();
    }

    function getSingleSignature($id_signature)
    {
        return Signature::where('id_signature', '=', $id_signature)->firstOrFail();
    }

    function getPraticienSignature($email_praticien)
    {
        return Signature::where('email_praticien', '=', $email_praticien)->firstOrFail();
    }
}
