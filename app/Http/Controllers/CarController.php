<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index() {
        $cars = Car::all(); //car var with car class function listing all//
        $cars = Car::paginate(10);// page only display 10 cars per page
        return view('cars', compact('cars'));

    }
}
