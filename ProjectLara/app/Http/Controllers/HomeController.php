<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view('home'); // returns the 'resources/views/home.blade.php' view
    }

}
