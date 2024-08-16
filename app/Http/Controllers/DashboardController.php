<?php

namespace App\Http\Controllers;

use Inertia\Response;

class DashboardController
{
    public function index(): Response
    {
        return inertia('Dashboard');
    }
}
