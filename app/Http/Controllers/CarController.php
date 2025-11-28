<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::query();

        // If a search term exists and is not empty after trimming
        $search = trim($request->search);
        if (!empty($search)) {
           $query->where(function ($q) use ($search) {
    $q->where('title', 'LIKE', "%{$search}%");
    // You can also search other existing columns like price, mileage if needed
    });

        }

        // Pagination with search term preserved
        $cars = $query->paginate(10)->withQueryString();

        return view('cars', compact('cars'));
    }
}
