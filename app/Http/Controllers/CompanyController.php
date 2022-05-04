<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Info;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
  public function updatecontacts(Request $request){


      $contacts=Contact::all()->first();
      if ($contacts){
          $contacts->update([
              "address" =>$request->address,
              "email" =>$request->email,
              "phone" =>$request->phone,

          ]);
          $contacts->save();
      }else{

          $contact = Contact::create([
              'address' => $request->address,
              'email' => $request->email,
              'phone' => $request->phone,

          ]);
          $contact->save();
          return response()->json(['contact' => $contact], 200);
      }
  }

  public function getcontact(){
      $contact=Contact::all()->first();
      return response()->json(['contact' => $contact], 200);
  }

    public function getinfo(){
        $info=Info::all()->first();
        return response()->json(['info' => $info], 200);
    }

    public function aboutUs(Request  $request)
    {
        $info=Info::all()->first();
        if ($info){

            $upload_path = public_path('logo');
            $new_name = time() . '.' . $request['file']->getClientOriginalName();
            $uploaded= $request['file']->move($upload_path, $new_name);

            $info->update([
                "name" =>$request->name,
                "about" =>$request->about,
                "file" => $new_name,

            ]);
            $info->save();

        }else{

            $upload_path = public_path('logo');
            $generated_new_name = time() . '.' . $request->file->getClientOriginalName();
            $uploaded= $request->file->move($upload_path, $generated_new_name);

            $info = Info::create([
                'name' => $request->name,
                'about' => $request->about,
                'file' => $generated_new_name,

            ]);

            $info->save();

            return response()->json(['info' => $info], 200);

        }
    }
}
