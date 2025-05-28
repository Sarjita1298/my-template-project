<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report; // assuming you have a Report model

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::latest()->get();
        return view('backend.reports.index', compact('reports'));
    }

    public function create()
    {
        return view('backend.reports.create');
    }

  public function store(Request $request)
{
    $request->validate([
        'order_id' => 'required|string|max:100', // Assuming order_id is stored as string
        'customer_name' => 'required|string|max:255',
        'total_price' => 'required|numeric',
        'order_date' => 'required|date', // Validates correct date format
        'order_status' => 'required|string|max:100',
        'shipping_status' => 'nullable|string|max:255',
    ]);

    Report::create([
        'order_id' => $request->order_id,
        'customer_name' => $request->customer_name,
        'total_price' => $request->total_price,
        'order_date' => $request->order_date,
        'order_status' => $request->order_status,
        'shipping_status' => $request->shipping_status,
    ]);

    return redirect()->route('reports.index')->with('success', 'Report created successfully.');
}


    public function edit($id)
    {
        $report = Report::findOrFail($id);
        return view('backend.reports.edit', compact('report'));
    }

  public function update(Request $request, $id)
{
    $request->validate([
        'order_id' => 'required|string|max:100',
        'customer_name' => 'required|string|max:255',
        'total_price' => 'required|numeric',
        'order_date' => 'required|date',
        'order_status' => 'required|string|max:100',
        'shipping_status' => 'nullable|string|max:255',
    ]);

    $report = Report::findOrFail($id);

    $report->update([
        'order_id' => $request->order_id,
        'customer_name' => $request->customer_name,
        'total_price' => $request->total_price,
        'order_date' => $request->order_date,
        'order_status' => $request->order_status,
        'shipping_status' => $request->shipping_status,
    ]);

    return redirect()->route('reports.index')->with('success', 'Report updated successfully.');
}


    public function destroy($id)
    {
        Report::destroy($id);
        return redirect()->route('reports.index')->with('success', 'Report deleted.');
    }

    public function info($id)
{
    $report = Report::findOrFail($id); // Make sure the model exists
    return view('backend.reports.info', compact('report'));
}


    // =====================
    // Optional Order Actions
    // =====================

    // public function updateStatus(Request $request, $id)
    // {
    //     $report = Report::findOrFail($id);
    //     $report->order_status = $request->input('order_status');
    //     $report->save();

    //     return back()->with('success', 'Order status updated.');
    // }
    public function updateStatus(Request $request, $id)
{
      $order = Report::findOrFail($id);
    $order->order_status = $request->order_status;
    $order->save();
    return redirect()->route('reports.index')->with('success', 'Order status updated successfully.');
}


    public function shipping($id)
    {
        $report = Report::findOrFail($id);
        $report->shipping_status = 'Shipped'; // example column
        $report->save();

        return redirect()->route('reports.index')->with('success', 'Order marked as shipped.');
    }
//     public function shipping($id)
// {
//     // Logic to handle shipping action
//     $order = Order::findOrFail($id);
//     return view('orders.shipping', compact('order'));
// }


    // =====================
    // Optional Return Actions
    // =====================

    public function approveReturn($id)
    {
        $report = Report::findOrFail($id);
        $report->return_status = 'Approved';
        $report->save();

        return redirect()->route('reports.index')->with('success', 'Return approved.');
    }

    public function rejectReturn($id)
    {
        $report = Report::findOrFail($id);
        $report->return_status = 'Rejected';
        $report->save();

        return back()->with('success', 'Return rejected.');
    }

    public function pickedReturn($id)
    {
        $report = Report::findOrFail($id);
        $report->return_status = 'Picked';
        $report->save();

        return back()->with('success', 'Return item picked.');
    }

    public function refundReturn($id)
    {
        $report = Report::findOrFail($id);
        $report->return_status = 'Refunded';
        $report->save();

        return back()->with('success', 'Return refunded.');
    }

    public function completeReturn($id)
    {
        $report = Report::findOrFail($id);
        $report->return_status = 'Completed';
        $report->save();

        return back()->with('success', 'Return completed.');
    }
}
