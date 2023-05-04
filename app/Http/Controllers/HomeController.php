<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
// use Cookie;
use Symfony\Component\HttpFoundation\Cookie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function setCookie(Request $request){
        $minutes = 10;
        // $response = new Response('Set Cookie');
        // $response->withCookie(cookie('laravel_cookie', 'true', $minutes));
        // return $response;
        $cookie = cookie('laravel_cookie', 'true', $minutes);
        return response('Hello World')->cookie($cookie);
    }

    public function getCookie(Request $request){
        $value = $request->cookie('laravel_cookie');
        echo $value;
    }

    // public function userLogin(Request $request){
    //     // show login form
    //     $value = $request->cookie('laravel_cookie');
    //     echo $value;
    // }
    
}

