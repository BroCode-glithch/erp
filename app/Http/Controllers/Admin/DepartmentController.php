<?php

namespace App\Http\Controllers\Admin;

use App\Models\Departments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Departments::all();

        return view('admin.departments.index', compact(var_name: 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
        ]);

        Departments::create($request->only('name'));

        // SweetAlert success message
        Alert::success('Created', 'Department created  successfully.');

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
        return view('admin.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Departments $department)
    {
        $request->validate([
            'name' => 'required|max:255|string',
        ]);

        $department->update($request->only('name'));

        // SweetAlert success message
        Alert::success('Deleted', 'Department updated successfully.');

        return redirect()->route('admin.departments.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departments $department)
    {
        $department->delete();

        // SweetAlert success message
        Alert::success('Deleted', 'Department deleted successfully.');

        return redirect()->route('admin.departments.index');
    }

}
