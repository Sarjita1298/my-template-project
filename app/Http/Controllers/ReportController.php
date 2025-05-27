<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report; // assuming you have a Report model

class ReportController extends Controller
{
    // Show all reports
    public function index()
    {
        $reports = Report::latest()->get();
        return view('backend.reports.index', compact('reports'));
    }

    // Show create form
    public function create()
    {
        return view('backend.reports.create');
    }

    // Store new report
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'customer_name' => 'required|string|max:255',
            'total_price' => 'required|numeric',
            'order_date' => 'required|date',
            'order_status' => 'required|string|max:50',
        ]);

        Report::create([
            'order_id' => $request->order_id,
            'customer_name' => $request->customer_name,
            'total_price' => $request->total_price,
            'order_date' => $request->order_date,
            'order_status' => $request->order_status,
        ]);

        return redirect()->route('reports.index')->with('success', 'Report created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $report = Report::findOrFail($id);
        return view('backend.reports.edit', compact('report'));
    }

    // Update report
    public function update(Request $request, $id)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'customer_name' => 'required|string|max:255',
            'total_price' => 'required|numeric',
            'order_date' => 'required|date',
            'order_status' => 'required|string|max:50',
        ]);

        $report = Report::findOrFail($id);
        $report->update($request->only('order_id', 'customer_name', 'total_price', 'order_date', 'order_status'));

        return redirect()->route('reports.index')->with('success', 'Report updated successfully.');
    }

    // Show single report info (for modal or detail page)
    public function info($id)
    {
        $report = Report::findOrFail($id);
        return view('backend.reports.info', compact('report'));
    }

    // Delete report
    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return redirect()->route('reports.index')->with('success', 'Report deleted successfully.');
    }
}
