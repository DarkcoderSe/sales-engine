<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesEngineController extends Controller
{
    public function create()
    {
        return view('sales-engine.create');
    }

    public function search()
    {
        return view('sales-engine.search');
    }

    public function result(Request $request)
    {
        return view('sales-engine.result');
    }
}
