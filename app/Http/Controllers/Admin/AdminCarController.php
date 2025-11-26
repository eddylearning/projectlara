<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class AdminCarController extends Controller
{
    public function index()
    {
        $cars = Car::latest()->paginate(10);
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'mileage' => 'required|numeric',
            'image_url' => 'nullable|url',
        ]);

        Car::create($validated);

        return redirect()->route('admin.cars.index')
        ->with('success', 'Car added successfully!');
    }

    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'mileage' => 'required|numeric',
            'image_url' => 'nullable|url',
        ]);

        $car->update($validated);

        return redirect()->route('admin.cars.index')
        ->with('success', 'Car updated successfully!');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('admin.cars.index')
        ->with('success', 'Car deleted successfully!');
    }
}
