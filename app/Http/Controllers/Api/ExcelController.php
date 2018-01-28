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


        if ($extension === 'xls') {

            // $companies = Company::first();
            // if (!empty($companies)) {
            //     Company::truncate();
            // }

            $data = \Excel::load(Input::file('file'))->get();

            // print_r($data); die();

            if ($data->count() /*&& empty(Company::first())*/  ) {

                foreach ($data as $key => $value) {
                        "{$key} => {$value} ";

                }
                if (!empty($data)) {
                	//print_r($arr);die();
                   // $companies = Company::insert($arr);
                    //dd('Insert Record successfully.');
                   // $companies = Company::all();
                   	$companies = collect($data);
                    return view('main')->with(
                        'companies', $companies);
                }

            }
        }else{
        	return view('main')->with(
              'error', 'Not supported format');
        }

    }

}
