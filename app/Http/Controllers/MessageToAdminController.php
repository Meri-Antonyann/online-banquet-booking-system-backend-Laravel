<?php

namespace App\Http\Controllers;

use App\Models\GuestMessage;
use App\Models\RemarkMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageToAdminController extends Controller
{
    public function GuestMessage(Request $request){

       $message = GuestMessage::create([
           'message'=> $request->message,
           'email'=>$request->email
       ]);
        $message->save();
    }
    public function GetGuestMessage(){

       $message  =GuestMessage::latest()->get();
        return response()->json(['messages' => $message ]);

    }
    public function deleteQuery($id){
        GuestMessage::latest()->where('id', $id)->delete();

    }
      public function sendRemark(Request $request, $id){
           $mess=count($request->inputtext)-1 ;
           $message = RemarkMessage::create([
               'message'=> $request->inputtext[$mess],
               'user_id'=> Auth::id(),
               'receiver_id'=> $id,
               'booking_id'=>$mess
           ]);
            $message->save();
      }

//         public function getRemark(){
//                $userid = Auth::id();
//               $remarks= RemarkMessage::with('booking')->where('receiver_id', $userid)->get();
//             return response()->json(['remarks' => $remarks ]);
//         }

}
