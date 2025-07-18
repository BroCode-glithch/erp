<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Programs;
use App\Models\Departments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $chartData = [
            'users' => [
                'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                'data' => [10, 20, 30, 25, 40, 60], // This would be dynamic when users login would be tracked monthly
            ],
            'roles' => [
                'labels' => Role::pluck('name'),
                'data' => Role::all()->map(function ($role) {
                    return DB::table('model_has_roles')
                        ->where('role_id', $role->id)
                        ->where('model_type', 'App\Models\User')
                        ->count();
                }),
            ],
            'programs' => [
                'labels' => ['Programs'], // single label
                'data' => [Programs::count()],
            ],
            'departments' => [
                'labels' => ['Departments'], // single label
                'data' => [Departments::count()],
            ],
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

        $programs_query = Programs::query();

        if ($request->filled('program-search')) {
            $search = $request->input('program-search');
            // Filter departments based on the search query
            $programs_query->where('name', 'like', "%{$search}%");
        }

        // if the query is not found
        if ($programs_query->count() === 0) {
            // Flash a message if no departments found
            Session::flash('message', 'No programs found.');
        }


        // Fetch all programs paginated to 10
        $programs = $programs_query->latest()->paginate(10);

        $users_query = User::with('roles')
            ->where('id', '!=', Auth::id()); // Exclude current user

        // Optional: Exclude users with specific role (e.g., 'admin')
        $users_query->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        });

        // Apply search filter
        if ($request->filled('user-search')) {
            $search = $request->input('user-search');
            $users_query->where('name', 'like', "%{$search}%");
        }

        // Flash a message if no results
        if ($users_query->count() === 0) {
            Session::flash('message', 'No users found.');
        }

        // Paginate results
        $users = $users_query->latest()->paginate(10);
        return view('admin.dashboard', compact('counts', 'chartData', 'departments', 'users', 'programs'));
    }
}
