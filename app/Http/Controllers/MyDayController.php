<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MyDayController extends Controller
{
    public function show(Request $request)
    {
        return Inertia::render('MyDay', [
            'tasks' => auth()->user()->myDayTasks,
        ]);
    }
}
