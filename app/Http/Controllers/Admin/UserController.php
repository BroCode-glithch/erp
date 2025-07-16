<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ensure the user is authorized to view this page
        if (!Auth::user()->can('view users')) {
            abort(403, 'Unauthorized action.');
        }

        // Fetch users with roles, excluding the currently authenticated user
        $users = User::with('roles')
            ->where('id', '!=', Auth::id())
            ->get(); // show all users except admin

        // Return the view with the users data
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ensure the user is authorized to view this page
        if (!Auth::user()->can('view users')) {
            abort(403, 'Unauthorized action.');
        }

        // Fetch the user with roles
        if (!User::where('id', $id)->exists()) {
            abort(404, 'User not found.');
        }

        $user = User::with('roles')->findOrFail($id);

        // Return the view with the user data
        return view('admin.users.view-user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ensure the user is authorized to edit this page
        if (!Auth::user()->can('edit users')) {
            abort(403, 'Unauthorized action.');
        }

        // Check if the user exists
        if (!User::where('id', $id)->exists()) {
            abort(404, 'User not found.');
        }

        // Fetch the user with roles
        $user = User::findOrFail($id);
        $roles = Role::all();

        // Return the view with the user and roles data
        return view('admin.users.edit', compact('user', 'roles'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Ensure the user is authorized to update this page
        if (!Auth::user()->can('edit users')) {
            abort(403, 'Unauthorized action.');
        }

        // Check if the user exists
        if (!User::where('id', $id)->exists()) {
            abort(404, 'User not found.');
        }

        // Fetch the user
        $user = User::findOrFail($id);

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'roles' => 'nullable|array'
        ]);


        // Update the user details
        $user->name = $request->name;
        $user->email = $request->email;

        // Only update the password if it is provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // If the user is not an admin, ensure they cannot assign admin roles
        if (!Auth::user()->hasRole('admin') && $request->has('roles') && in_array('admin', $request->roles)) {

            // Flash an error message
            Session::flash('error', 'You do not have permission to assign admin roles.');


            // Redirect back
            return redirect()->back();
        }

        // Save the user
        $user->save();

        // Convert role IDs to names
        $roleNames = Role::whereIn('id', $request->roles ?? [])->pluck('name')->toArray();

        // Sync by name
        $user->syncRoles($roleNames);

        // Flash a success message
        Session::flash('success', 'User updated successfully.');

        // Redirect to the users index
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Ensure the user is authorized to delete this page
        if (!Auth::user()->can('delete users')) {
            abort(403, 'Unauthorized action.');
        }

        // Check if the user exists
        if (!User::where('id', $id)->exists()) {
            abort(404, 'User not found.');
        }

        // Fetch the user and delete
        $user = User::findOrFail($id);
        $user->delete();

        // Flash a success message
        Session::flash('success', 'User deleted successfully.');

        // Redirect to the users index
        return redirect()->route('admin.users.index');
    }


    public function exportPDF()
    {
        // Fetch all programs from the db
        $users = User::all();

        // Get current user and date for filename
        $user = auth()->user()->name ?? 'user';
        $date = now()->format('Y-m-d_H-i-s');

        // Load the PDF view with the users data
        $pdf = Pdf::loadView('admin.users.pdf.pdf', compact('users'));

        // Ensure the user is authorized to export users
        if (!Auth::user()->can('export users')) {
            abort(403, 'Unauthorized action.');
        }

        // Flash a success message
        Session::flash('message', value: 'Users exported successfully.');

        // Create a descriptive filename
        $filename = "users-{$user}-{$date}.pdf";

        return $pdf->download($filename);
    }
}
