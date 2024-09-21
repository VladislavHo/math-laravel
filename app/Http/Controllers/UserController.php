<?php

// namespace App\Http\Controllers\UserController;
namespace App\Http\Controllers;
use App\Models\User;  
use Illuminate\Http\Request;
class UserController
{
    //

    public function create(Request $request){
      $user = User::create($request->all());
      \Log::info("User created". $user);
      return response()->json([
        'status' => '200',
        ]);
    }
}
