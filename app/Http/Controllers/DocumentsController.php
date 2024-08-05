<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    //
    function getAllDocuments(){
        return Document::all();
    }

    function getSingleDocument($id_document){
        return Document::where('id_document', '=', $id_document)->firstOrFail();
    }

    function getAllUserDocuments($email_utilisateur){
        return Document::where('email_utilisateur', '=', $email_utilisateur)->get();
    }

    function addDocument(Request $req)
    {
        $document = new Document();
        $document->email_utilisateur = $req->email_utilisateur;
        $document->nom_document = $req->nom_document;
        $document->file_name = $req->file_name;
    

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
}
