<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function dashboardMaintain()
    {
        return view('user.main.dashboard-maintain');
    }

    public function superAdminDashboard()
    {
        return view('user.main.dashboard');
    }

    public function siswaDashboard()
    {
        return view('user.main.dashboard-siswa');
    }

    public function walikelasDashboard()
    {
        return view('user.main.dashboard-walikelas');
    }

    public function guruBkDashboard()
    {
        return view('user.main.dashboard-guru-bk');
    }

    public function kesiswaanDashboard()
    {
        return view('user.main.dashboard-kesiswaan');
    }

}
