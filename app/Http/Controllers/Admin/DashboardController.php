<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        $update = session('message_update');

        $notifications = ['ciao', 'come'];

        if ($update !== '...') {
            $notifications[] = $update;
        }

        return view('dashboard', compact('projects', 'notifications'));
    }
}
