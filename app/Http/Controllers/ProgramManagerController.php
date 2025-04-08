<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgramManagerController extends Controller
{
    public function index()
    {
        return view("pm.dashboard");
    }
}
