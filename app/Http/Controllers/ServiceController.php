<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function addservice(Request $request){


        $service = Service::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);
        $service->save();

    }

    public function getservices(){
        $services = DB::table('services')->latest()->get();
        return response()->json(['services' => $services]);
    }

    public  function deleteService($id){
        DB::table('services')->where('id', $id)->delete();
        return response()->json([
            'message'=>'Service Deleted Successfully!!'
        ]);
    }

    public  function showservice($id){
        $service=   DB::table('services')->where('id', $id)->get();
        return response()->json([
            'service'=>$service
        ]);
    }
    public function updateservice(Request $request,$id)
    {
        $data=Service::findOrFail($id);

        $data->update([
            "name" =>$request->name,
            "price" =>$request->price,

        ]);

    }
    public function services(){
        $services=Service::all()->count();

        return response()->json(['totalServices' => $services]);
    }
}
