<?php

namespace App\Http\Controllers;

use App\Models\WithdrawalRequest;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    //

    function getAllWithdrawalRequests(){
        return WithdrawalRequest::all();
    }

    function getAllPraticianWithdrawalRequests($sender_id)
    {
        return WithdrawalRequest::where('sender_id', '=', $sender_id)->get();
    }

    function addWithdrawalRequest(Request $req)
    {
        $withdrawal = new WithdrawalRequest();
        $withdrawal->sender_id = $req->sender_id;
        $withdrawal->sender_name = $req->sender_name;
        $withdrawal->amount = $req->amount;
        $withdrawal->payment_method = $req->payment_method;
        $withdrawal->status = $req->status; 

        $result = $withdrawal->save();

        if ($result) {
            return [
                "status" => "success",
                "data" => $withdrawal,
            ];
        } else {
            return [
                "status" => "failed",
                "data" => null,
            ];
        }
    }
}
