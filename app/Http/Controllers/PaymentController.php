<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    function getAllPayments()
    {
        return Payment::all();
    }

    function addPayment(Request $req)
    {
        $payment = new Payment();
        $payment->service = $req->service;
        $payment->amount = $req->amount;
        $payment->method = $req->method;
        $payment->author = $req->author;
        $payment->receiver = $req->receiver;
        $payment->status = $req->status;

        $result = $payment->save();

        if ($result) {
            // $payment->id_payment = $payment->id;
            return [
                "status" => "success",
                "data" => $payment,
            ];
        } else {
            return [
                "status" => "failed",
                "data" => null,
            ];
        }
    }
}
