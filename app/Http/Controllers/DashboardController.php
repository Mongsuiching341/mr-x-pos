<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia('Home');
    }

    // public function productsPage()
    // {
    //     return Inertia('dashboard/Products', ['data' => 'hello']);
    // }
}
