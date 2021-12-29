<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Trainings;

class HomeController extends Controller
{
    
    public function __construct()
    {
        if(!$login = Session::get('auth')){
            $this->middleware('auth');
        }
    }
    
    public function index()
    {
        $trainings = Trainings::all();
        return view('home', [
            'trainings' => $trainings
        ]);
    }
}
