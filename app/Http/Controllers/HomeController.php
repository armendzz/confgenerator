<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('home');
    }
    public function unrealgen(){
        return view('unrealgen');
    }
    public function anopegen(){
        return view('anopegen');
    }
    public function eggdroplgen(){
        return view('eggdroplgen');
    }

    public function unrealgenr(Request $request){
        /* dd($request); */
        return view('unrealresult')->with('request', $request);
    }
    public function anopegenr(Request $request){

        return view('anoperesult')->with('request', $request);
    }
    public function eggdroplgenr(Request $request){

        return view('eggdropresult')->with('request', $request);
    }
}
