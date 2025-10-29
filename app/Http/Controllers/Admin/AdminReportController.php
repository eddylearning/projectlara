<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Car;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    /**
     * Display a listing of the reports.
     */
    public function index()
    {
        $reports = Report::with('car')->latest()->paginate(10);
        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new report.
     */
    public function create()
    {
        $cars = Car::all();
        return view('admin.reports.create', compact('cars'));
    }

    /**
     * Store a newly created report in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'car_id' => 'required|exists:cars,id',
        ]);

        Report::create($validated);

        return redirect()->route('admin.reports.index')
                         ->with('success', 'Report created successfully!');
    }

    /**
     * Show the form for editing the specified report.
     */
    public function edit(Report $report)
    {
        $cars = Car::all();
        return view('admin.reports.edit', compact('report', 'cars'));
    }

    /**
     * Update the specified report in storage.
     */
    public function update(Request $request, Report $report)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'car_id' => 'required|exists:cars,id',
        ]);

        $report->update($validated);

        return redirect()->route('admin.reports.index')
                         ->with('success', 'Report updated successfully!');
    }

    /**
     * Remove the specified report from storage.
     */
    public function destroy(Report $report)
    {
        $report->delete();

        return redirect()->route('admin.reports.index')
                         ->with('success', 'Report deleted successfully!');
    }
}
