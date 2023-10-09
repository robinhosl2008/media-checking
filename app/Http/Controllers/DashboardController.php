<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('midia-checking.validar');
    }
}
