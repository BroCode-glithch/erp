<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all roles with their permissions
        $roles = Role::with('permissions')->get();

        // Return the view with roles data
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all permissions to display in the create role form
        $permissions = Permission::all();

        // Return the view with permissions data
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);


        // Create the role with the provided name
        $role = Role::create(['name' => $request->name]);

        // Sync permissions if provided
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        Session::flash('message', 'Role created successfully!');

        // Redirect to roles index with success message
        return redirect()->route('admin.roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Fetch the role by ID and its permissions
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        // Return the view with role and permissions data
        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Fetch the role by ID
        $role = Role::findOrFail($id);

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // Update the role with the new name
        $role->update(['name' => $request->name]);

        // Sync permissions if provided
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        // Flash success message
        Session::flash('message', 'Role updated successfully!');

        // Redirect to roles index with success message
        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the role by ID and delete it
        $role = Role::findOrFail($id);
        $role->delete();

        // Flash success message
        Session::flash('message', 'Role deleted successfully!');

        // Redirect to roles index with success message
        return redirect()->route('admin.roles.index');
    }

    public function exportPDF ()
    {
        // Fetch all programs from the db
        $roles = Role::all();

        // Get current user and date for filename
        $user = auth()->user()->name ?? 'user';
        $date = now()->format('Y-m-d_H-i-s');

        // Load the PDF view with the programs data
        $pdf = Pdf::loadView('admin.roles.pdf.pdf', compact('roles'));

        // Flash a success message
        Session::flash('message', 'Roles exported successfully.');

        // Create a descriptive filename
        $filename = "roles-{$user}-{$date}.pdf";

        return $pdf->download($filename);
    }
}
