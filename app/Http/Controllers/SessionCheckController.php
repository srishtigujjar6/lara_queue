<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionCheckController extends Controller
{
    public function accessSessionByKey(Request $request) {
        if($request->session()->has($request->key))
            echo $request->session()->get($request->key);
        else
           echo 'No data in session';
     }
     
     public function accessSession(Request $request) {
        if($request->session()->all())
            dump($request->session()->all());
        else
           echo 'No data in session';
     }
     
     public function storeSession(Request $request) {
        $request->session()->put('key','Session Value!');
        $request->session()->put('key2','Session Value 2!');
        echo "Data added to session";
     }
     
     public function deleteSessionByKey(Request $request) {
        // $request->session()->forget($request->key);
        echo $request->session()->pull($request->key); // Retrieve data and deletes it.
        echo " Data removed from session.";
     }

     public function deleteSession(Request $request) {
        $request->session()->flush();
        echo "Data removed from session.";
     }

   public function getAuthUser() {
      dd(Auth::user());
   }
     
}
