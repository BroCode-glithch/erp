<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Displays the admin dashboard
        return view("admin.dashboard");
    }
}
