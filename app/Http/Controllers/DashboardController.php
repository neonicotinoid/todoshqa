<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('dashboard')->with([
            'projects' => auth()->user()->projects
        ]);
    }
}
