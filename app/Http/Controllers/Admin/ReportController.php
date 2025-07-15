<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index() 
    {
        // Return the view for the reports index page
        return view('admin.reports.index');
    }
}
