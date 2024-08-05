<?php

namespace App\Http\Controllers;

use App\Models\Availabilities;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    //
    function createAvailability(Request $req)
    {
        $avaibility = new Availabilities();

        $avaibility->id_praticien = $req->id_praticien;
        $avaibility->begin_date = $req->begin_date;
        $avaibility->end_date = $req->end_date;
        $avaibility->begin_hour = $req->begin_hour;
        $avaibility->end_hour = $req->end_hour;
        $avaibility->consultation_length = $req->consultation_length;
        $avaibility->has_sunday = $req->has_sunday;

        $result = $avaibility->save();

        if ($result) {
            return [
                "status" => "success",
                "data" => $avaibility,
            ];
        } else {
            return [
                "status" => "failed",
                "data" => null,
            ];
        }
    }

    function getAllPraticiansAvailabilites($idPraticians){
        return  Availabilities::where('id_praticien', '=', $idPraticians)->get();
    }
}
