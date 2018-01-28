<?php

namespace App\Http\Controllers\Api;

use App\Company;
use App\Http\Controllers\Controller;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Storage;

class ExcelController extends Controller
{

    public function upload(Request $request)
    {
        $file = Input::file('file');

        $extension = $file->getClientOriginalExtension();
        $storelocal = Storage::disk('local');
        $fileName  = $file->getClientOriginalName();
        //$storelocal->put('xls/' . $fileName, file_get_contents($file), 'public');

        $data = \Excel::load($file, function($reader) {
        $reader->ignoreEmpty();
        $reader->skipRows(0);    
        $reader->limitColumns(4);
        }, 'UTF-8')->get();

        if ($file && $extension === 'xls' && $data->count()) {

            // $companies = Company::first();
            // if (!empty($companies)) {
            //     Company::truncate();
            // }


                foreach ($data as $key => $value) {
                    $skip=0;    
                   
                    foreach ($value as $keys => $valuevalue) {
                        if(empty($valuevalue)){
                           $skip = 1; 
                        }
                    }
                    if($skip === 0){
                        "{$key} => {$value} ";
                    }else{
                        unset($data[$key]);
                    }
                }


                if (!empty($data)) {
                	//print_r($arr);die();
                   // $companies = Company::insert($arr);
                    //dd('Insert Record successfully.');
                   // $companies = Company::all();
                   	$companies = collect($data);
                    //print_r($companies); die();

                    return view('main')->with(
                        'companies', $companies);
                }

            }else{
            	return view('main')->with(
                  'error', 'Not supported format');
            }

    }

}
