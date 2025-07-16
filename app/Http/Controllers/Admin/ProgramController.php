<?php

namespace App\Http\Controllers\Admin;

use App\Models\Programs;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Programs::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            // Filter programs based on the search query
            $query->where('name', 'like', "%{$search}%");
        }

        // if the query is not found
        if ($query->count() === 0) {
            // Flash a message if no programs found
            Session::flash('message', value: 'No programs found.');
        }


        // Fetch all programs paginated to 10
        $programs = $query->latest()->paginate(10);

        // Return the view with programs data
        // Using compact to pass the variable to the view
        return view('admin.programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view for creating a new program
        return view('admin.programs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new program with the validated data
        Programs::create(
            $request->only('name')
        );

        // Flash a success message
        Session::flash('message', 'Program created successfully.');

        // Redirect to the index route after creation
        return redirect()->route('admin.programs.index');
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
    public function edit(Programs $program)
    {
        // Return the view for editing the specified program
        // Using compact to pass the variable to the view
        return view('admin.programs.edit', compact(var_name: 'program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Programs $program)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|max:255|string',
        ]);

        // Update the program with the validated data
        $program->update($request->only('name'));

        // Flash success message
        Session::flash('message', 'Program updated successfully.');

        // Redirect to the index route after updating
        return redirect()->route('admin.programs.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Programs $program)
    {
        // Delete the specified program
        $program->delete();

        // Flash a success message
        Session::flash('message', 'Program deleted successfully.');

        // Redirect to the index route after deletion
        return redirect()->route('admin.programs.index');
    }

    public function exportPDF ()
    {
        // Fetch all programs from the db
        $programs = Programs::all();

        // Get current user and date for filename
        $user = auth()->user()->name ?? 'user';
        $date = now()->format('Y-m-d_H-i-s');

        // Load the PDF view with the programs data
        $pdf = Pdf::loadView('admin.programs.pdf.pdf', compact('programs'));

        // Flash a success message
        Session::flash('message', 'Programs exported successfully.');

        // Create a descriptive filename
        $filename = "programs-{$user}-{$date}.pdf";

        return $pdf->download($filename);
    }
}
