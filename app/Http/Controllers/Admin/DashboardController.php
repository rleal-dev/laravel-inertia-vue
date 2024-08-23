<?php

namespace App\Http\Controllers\Admin;

use Inertia\Response;

class DashboardController
{
    public function index(): Response
    {
        return inertia('Dashboard');
    }
}
