<?php

namespace App\Http\Controllers;

use App\Models\Programs;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProgramManagerController extends Controller
{
/**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Programs::all();
        return view(view: 'pm.programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(view: 'pm.programs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Programs::create(
            $request->only('name')
        );

        // SweetAlert success message
        Alert::success('Created', 'Department created  successfully.');

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
        return view('pm.programs.edit', compact(var_name: 'program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Programs $program)
    {
        $request->validate([
            'name' => 'required|max:255|string',
        ]);

        $program->update($request->only('name'));

        // SweetAlert success message
        Alert::success('UPdated', text: 'Program updated successfully.');

        return redirect()->route(route: 'pm.programs.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Programs $program)
    {
        $program->delete();

        // SweetAlert success message
        Alert::success('Deleted', 'Department created  successfully.');

        return redirect()->route(route: 'pm.programs.index');
    }
}
