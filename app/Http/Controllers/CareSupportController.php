<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CareSupportController extends Controller
{
    public function index()
    {
        return view("care.dashboard");
    }
}
