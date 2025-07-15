<?php

namespace App\Http\Controllers;

use App\Models\Programs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProgramManagerController extends Controller
{
/**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all programs from the database
        // and pass them to the view
        $programs = Programs::all();

        // Return the view with the programs data
        return view(view: 'pm.programs.index', compact(var_name: 'programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view for creating a new program
        return view(view: 'pm.programs.create');
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
        Session::flash('success', 'Program created successfully.');


        // Redirect to the index route of the program manager
        return redirect()->route('pm.programs.index');
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
        // Pass the program data to the view
        return view('pm.programs.edit', compact(var_name: 'program'));
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

        // Updated the program with the validated data
        // Used the fill method to update the model
        $program->update($request->only('name'));

        // Flash a success message
        Session::flash('success', 'Program updated successfully.');


        return redirect()->route(route: 'pm.programs.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Programs $program)
    {
        // Delete the specified program
        $program->delete();

        // Flash a success message
        Session::flash('success', 'Program deleted successfully.');

        // Redirect to the index route of the program manager
        return redirect()->route(route: 'pm.programs.index');
    }
}
