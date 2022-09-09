<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

class HomeController extends Controller
{
    //
    public function index(Request $request){
        
        $data["code"] = $_GET["code"];
        $data["credentialsId"] = $_GET["credentialsId"];
         
        return view("success", $data);
    }

    public function submitPay(Request $request){

        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.banked.com/v2/payment_sessions",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\n    \"reference\": \"Illuminate\",\n    \"success_url\": \"http://localhost:8000/success?id=__PAYMENT_ID__\",\n    \"error_url\": \"http://localhost:8000/error\",\n    \"line_items\": [\n      {\n        \"name\": \"aut\",\n        \"amount\": ".$request->amount.",\n        \"currency\": \"GBP\",\n        \"quantity\": 1\n      }\n    ],\n    \"payee\": {\n      \"name\": \"Vishal Vasant\",\n      \"account_number\": \"12345678\",\n      \"sort_code\": \"010203\"\n      },\n    \"email_receipt\": true\n}",
        CURLOPT_HTTPHEADER => array(
            "authorization: Basic cGtfdGVzdF9GT0ktbmNiTE9BUVFnRHpYNFZiQkdBOnNrX3Rlc3RfNjFjY2RkMGVkN2I3OTYyOTVhNmJkYWQwMTI3NzMzZjA=",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 76650fed-ca49-3f76-115b-fea127f6bdae"
        ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    $response = json_decode($response,true);
    $url = $response['url'];
    return Redirect::to($url);

    }

    public function paymentSuccess(Request $request){
        $data['id'] = $_GET['id'];
        return view("success", $data);
    }

    public function paymentError(Request $request){
        dd($_GET['id']);
    }
}
