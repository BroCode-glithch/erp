<?php

namespace App\Http\Controllers\Admin;

use App\Models\Departments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all departments
        $departments = Departments::all();

        // Return the view with departments data
        // Using compact to pass the variable to the view
        return view('admin.departments.index', compact(var_name: 'departments'));
    }

    /**
     * Show the form for creating a new resource.
    */
    public function create()
    {
        // Return the view for creating a new department
        return view('admin.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name'  => 'required|string|max:255',
        ]);

        // Create a new department
        Departments::create($request->only('name'));

        // Flash a success message
        Session::flash('message', 'Department created successfully!');

        // Return redirect route to index
        return redirect()->route('admin.departments.index');

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
    public function edit(Departments $department)
    {
        // Find the department by ID and return the edit view
        return view('admin.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Departments $department)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|max:255|string',
        ]);

        // Update the department
        $department->update($request->only('name'));

        // Flash a success message
        Session::flash('message', 'Department updated successfully!');

        // Redirect back to the departments index
        return redirect()->route('admin.departments.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departments $department)
    {
        $department->delete();

        Session::flash('message', 'Department deleted successfully!');

        return redirect()->route('admin.departments.index');
    }

}
