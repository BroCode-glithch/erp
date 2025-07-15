<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CareSupportController extends Controller
{
    public function index()
    {
        // Displays the care support dashboard
        return view("care.dashboard");
    }
}
