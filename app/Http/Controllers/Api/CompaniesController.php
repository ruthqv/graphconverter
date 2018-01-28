<?php

namespace App\Http\Controllers\Api;

use App\Helpers\CustomHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompaniesController extends Controller
{

    public function getCompanies(Request $request)
    {

         
         if ($request->isMethod('get')) { 
        
            $url = "https://api.opencorporates.com/v0.4/companies/search?q=a";


         }elseif($request->isMethod('post')){
          $data = $request->all();
          $companyName =    $data['data'];
          $url = "https://api.opencorporates.com/v0.4/companies/search?q=a".$companyName."";
         }
       

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_POSTFIELDS => "",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/json; charset=UTF-8;",
            "accept: application/json; charset=UTF-8;",

          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          return response()->json("cURL Error #:" . $err);
        } else {
          return response($response);
        }


    }
    public function selectCompany(Request $request)
    {

      $data=$request->all();
      $data = $data['data'];


      $url = "https://api.opencorporates.com/v0.4/companies/".$data[0]."/".$data[1]."";

      $response = $this->curlGet($url);
      return response($response);
    }

    public function curlGet($url){
       $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_POSTFIELDS => "",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/json; charset=UTF-8;",
            "accept: application/json; charset=UTF-8;",

          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          return response()->json("cURL Error #:" . $err);
        } else {
          return $response;
        }
    }
}
