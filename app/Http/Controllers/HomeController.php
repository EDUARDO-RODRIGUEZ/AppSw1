<?php

namespace App\Http\Controllers;

class HomeController extends Controller
//$this->middleware(['auth', 'verified']);

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
    public function indice()
    {

        return view('layout.plantilla');
    }

    public function miIndice()
    {
        return view('layout.plantilla');
    }
}
