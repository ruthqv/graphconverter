<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/upload', function()
{
    return view('upload');
});

Route::post('/uploadexcel', 'Api\ExcelController@upload')->name('uploadExcel');

Route::get('download/{file_name}', function($file_name = null)
{
    $path = storage_path().'/'.'app'.'/xls/'.$file_name;
    if (file_exists($path)) {
        return Response::download($path);
    }
})->name('download');


Route::get('/{path?}', function(){
	$examplecompanies = DB::collection('companies')->get();
	$examplecompaniesyears = DB::collection('companiesyears')->get();
	return view('main')->with(['examplecompanies'=> $examplecompanies, 'examplecompaniesyears' => $examplecompaniesyears]);
})->name('main');