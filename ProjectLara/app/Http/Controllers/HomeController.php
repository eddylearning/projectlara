<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        /*varibale name passing cars and compact used to handle varibale then in view page put name in <p>{{for echoing}}</p> to show it  */
        $name = cars;
        return view('home', compact('cars')); // returns the 'resources/views/home.blade.php' view
    }

}
