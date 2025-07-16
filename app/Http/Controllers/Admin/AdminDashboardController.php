<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Programs;
use App\Models\Departments;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;

class AdminDashboardController extends Controller
{
    public function index (Request $request)
    {
        // Fetch counts of various models
        // Using compact to pass the variable to the view
        // This will be used in the dashboard view
        $counts = [
            'roleCount' => Role::count(),
            'permissionCount' => Permission::count(),
            'userCount' => User::count(),
            'departmentCount' => Departments::count(),
            'programCount' => Programs::count(),
        ];

        $query = Departments::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            // Filter departments based on the search query
            $query->where('name', 'like', "%{$search}%");
        }

        // if the query is not found
        if ($query->count() === 0) {
            // Flash a message if no departments found
            Session::flash('message', 'No departments found.');
        }


        // Fetch all departments paginated to 10
        $departments = $query->latest()->paginate(10);
        

        // Ensure the user is authorized to view this page
        // if (!Auth::user()->can('view users')) {
        //     abort(403, 'Unauthorized action.');
        // }

        // Fetch users with roles, excluding the currently authenticated user
        $users = User::with('roles')
            ->where('id', '!=', Auth::id())
            ->get(); // show all users except admin

        // Fetch all programs from the db
        $programs = Programs::all();

        return view('admin.dashboard', compact('counts', 'departments', 'users', 'programs'));
    }
}
