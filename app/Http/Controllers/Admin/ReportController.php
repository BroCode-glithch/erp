<?php

namespace App\Http\Controllers\Admin;

use App\Models\Report;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Report::query();

        if ($request->filled('search')) {
            $search = $request->input(key: 'search');
            // Filter reports based on the search query
            $query->where('title', 'like', "%{$search}%");
        }

        // if the query is not found
        if ($query->count() === 0) {
            // Flash a message if no reports found
            Session::flash('message', 'No reports found.');
        }


        // Fetch all reports paginated to 10
        $reports = $query->latest()->paginate(10);

        // Return the view with reports data
        // Using compact to pass the variable to the view
        return view('admin.reports.index', compact('reports'));
    }

       /**
     * Show the form for creating a new resource.
    */
    public function create()
    {
        // Return the view for creating a new report
        return view('admin.reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title'  => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'type' => 'required|string|in:attendance,performance,summary',
            'filters' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Handle file upload if present
        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('reports', 'public');
        }

        // Create a new report
        Report::create($request->only('title', 'description', 'type', 'filters') + ['file_path' => $filePath ?? null]);

        // Flash a success message
        Session::flash('message', 'Report created successfully!');

        // Return redirect route to index
        return redirect()->route('admin.reports.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        // Find the report by ID and return the edit view
        return view('admin.reports.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|max:255|string',
        ]);

        // Update the report
        $report->update($request->only('name'));

        // Flash a success message
        Session::flash('message', 'Report updated successfully!');

        // Redirect back to the reports index
        return redirect()->route('admin.reports.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        $report->delete();

        Session::flash('message', 'Reports deleted successfully!');

        return redirect()->route('admin.reports.index');
    }

    /**
     * Export reports to PDF.
     */

    public function exportPDF()
    {
        // Fetch all reports from the db
        $reports = Report::all();

        // Get current user and date for filename
        $user = auth()->user()->name ?? 'user';
        $date = now()->format('Y-m-d_H-i-s');

        // Load the PDF view with the reports data
        $pdf = Pdf::loadView('admin.reports.pdf.pdf', compact('reports'));

        // Flash a success message
        Session::flash('message', 'Reports exported successfully.');

        // Create a descriptive filename
        $filename = "reports-{$user}-{$date}.pdf";

        return $pdf->download($filename);
    }
}
