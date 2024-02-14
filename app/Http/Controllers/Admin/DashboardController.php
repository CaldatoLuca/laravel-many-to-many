<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        // Recupera i messaggi di notifica dalla sessione
        $notifications = Session::get('dashboard_notifications', []);

        // Cancella i messaggi dalla sessione dopo averli recuperati
        Session::forget('dashboard_notifications');

        return view('dashboard', compact('projects'))->with('notifications', $notifications);
    }
}
