<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterVisitsController extends Controller
{
    public function index($schedule)
    {
        return view('register-visits', compact('schedule'));
    }

    public function finish($schedule)
    {
        return view('finish', compact('schedule'));
    }
}
