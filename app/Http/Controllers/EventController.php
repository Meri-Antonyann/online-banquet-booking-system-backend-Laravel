<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function addevent(Request $request){


        $event = Event::create([
            'name' => $request->name,
            ]);
        $event->save();

    }

    public function getevents(){
        $events = DB::table('events')->latest()->get();
        return response()->json(['events' => $events]);
    }

    public  function deleteEvent($id){
        DB::table('events')->where('id', $id)->delete();
        return response()->json([
            'message'=>'POst Deleted Successfully!!'
        ]);
    }

    public  function showevent($id){
     $event=   DB::table('events')->where('id', $id)->get();
        return response()->json([
            'event'=>$event
        ]);
    }
    public function updateevent(Request $request,$id)
    {
        $data=Event::findOrFail($id);

        $data->update([
            "name" =>$request->name,

        ]);

    }

    public function events(){
        $events=Event::all()->count();

        return response()->json(['totalEvents' => $events]);
    }


}
