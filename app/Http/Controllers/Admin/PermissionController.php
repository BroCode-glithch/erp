<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all permissions from the db
        $permissions = Permission::all();

        // Return the view with permissions data
        // Using compact to pass the variable to the view
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view for creating a new permission
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|unique:permissions,name|string|max:255',
        ]);

        // Create a new permission
        Permission::create(['name' => $request->name]);

        // Flash a success message
        Session::flash('message', 'Permission created successfully.');

        // Return redirect route to index
        return redirect()->route('admin.permissions.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Find the permission by ID and return the edit view
        $permission = Permission::findOrFail($id);

        // Return the view for editing the permission
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the permission by ID
        $permission = Permission::findOrFail($id);

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
        ]);

        // Update the permission
        $permission->update(['name' => $request->name]);

        // Flash a success message
        Session::flash('message', 'Permission updated successfully.');

        // Return redirect route to index
        return redirect()->route('admin.permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the permission by ID and delete it
        $permission = Permission::findOrFail($id);
        $permission->delete();

        // Flash a success message
        Session::flash('message', 'Permission deleted successfully.');

        // Return redirect route to index
        return redirect()->route('admin.permissions.index');
    }

            public function exportPDF ()
    {
        // Fetch all programs from the db
        $permissions = Permission::all();

        // Get current user and date for filename
        $user = auth()->user()->name ?? 'user';
        $date = now()->format('Y-m-d_H-i-s');

        // Load the PDF view with the programs data
        $pdf = Pdf::loadView('admin.permissions.pdf.pdf', compact('permissions'));

        // Flash a success message
        Session::flash('message', 'Permissions exported successfully.');

        // Create a descriptive filename
        $filename = "permissions-{$user}-{$date}.pdf";

        return $pdf->download($filename);
    }

}
