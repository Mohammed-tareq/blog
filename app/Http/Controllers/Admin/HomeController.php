<?php

namespace App\Http\Controllers\Admin;

use App\Charts\AllSystem;
use App\Charts\MonthlyPostsChart;
use App\Charts\MonthlyUsersChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(MonthlyPostsChart $monthlyPostsChart , MonthlyUsersChart $monthlyUsersChart,AllSystem $allSystem)
    {
        return view('admin.index',[
            'monthPosts' => $monthlyPostsChart->build(),
            'monthUsers' => $monthlyUsersChart->build(),
            'allSystem' => $allSystem->build(),
        ]);
    }
}
