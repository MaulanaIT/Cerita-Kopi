<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    function index() {
        $page = "Dashboard";
        $title = "Cerita Kopi - Dashboard";

        return View::make('dashboard')
            ->with('page', 'Dashboard')
            ->with('title', 'Cerita Kopi - Dashboard')
            ->render();
    }
}
