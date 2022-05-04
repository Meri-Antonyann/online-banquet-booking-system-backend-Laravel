<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class PassportAuthController extends Controller
{


    public function register(Request  $request)
    {
        $upload_path = public_path('avatar');
        $generated_new_name = time() . '.' . $request->file->getClientOriginalExtension();
        $uploaded= $request->file->move($upload_path, $generated_new_name);



        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'file'=> $generated_new_name,

        ]);
        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()->json(['token' => $token], 200);

        $user->save();

    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email  )->first();
        if (Hash::check($request->password, $user->password)) {
            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
            $response = ['token' => $token];
            return response($response);
        } else {
            $response = ["message" => "Password mismatch"];
            return response($response, 422);
        }

    }
    public function changePsw(Request $request, $id)
    {
        $user = User::where('id', $id  )->first();
        if (Hash::check($request->currPsw, $user->password)) {
            $user->update([
                "password" =>Hash::make($request->password),
            ]);

        } else {
            $response = ["message" => "Password mismatch"];
            return response($response, 422);
        }

    }

    public function me() {
        return response()->json(['user' => auth()->user()]);
    }

    public function update(Request $request )
    {
        $upload_path = public_path('avatar');
        $new_name = time() . '.' . $request['file']->getClientOriginalExtension();
        $uploaded= $request['file']->move($upload_path, $new_name);

        $user =Auth::user();
        $user->name = $request['name'];
        $user->surname = $request['surname'];
        $user->email = $request['email'];
        $user->password = $request['password'];
        $user->file = $new_name;
        $user->save();



    }

    public function getUsers(){
        $users = DB::table('users')->latest()->get();
        return response()->json(['users' => $users], 200);
    }
    public function logout(Request $request)
    {
         $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out',

        ]);

    }
}
