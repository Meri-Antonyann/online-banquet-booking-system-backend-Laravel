<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return  ('backend works ');
});


Route::get('/send', function (Request $request){
    $dummys = array(
        array(['name'=>'Enquiry', 'path'=>'/admin/enquiry-list']),
        array(['name'=>'Dummy List', 'path'=>''], ['name'=>'Dummy Link 1', 'path'=>'/admin'],  ['name'=>'Dummy Link 2', 'path'=>'/admin']),
        array(['name'=>'Dummy Link 1', 'path'=>'/admin']),
        array(['name'=>'Dummy List', 'path'=>''], ['name'=>'Dummy Link 1', 'path'=>'/admin'],  ['name'=>'Dummy Link 2', 'path'=>'/admin']),
        array(['name'=>'Dummy Link 1', 'path'=>'/admin']),
        array(['name'=>'Dummy List', 'path'=>''], ['name'=>'Dummy Link 1', 'path'=>'/admin'],  ['name'=>'Dummy Link 2', 'path'=>'/admin']),
        array(['name'=>'Dummy Link 1', 'path'=>'/admin']),
    );
    return response()->json([
        'msg' => 'From backend',
        'data' => $dummys
    ]);
});
