<?php

namespace App\Charts;

use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use \ArielMejiaDev\LarapexCharts\PolarAreaChart;
use \ArielMejiaDev\LarapexCharts\pieChart;

class MonthlyUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    function build(): polarAreaChart
    {
        $data = [];
        for($u = 1 ; $u <= 12 ; $u++){
            $data[] = User::whereYear('created_at',now()->year)->whereMonth('created_at',$u)->orderBy('created_at')->count();
        }
        return $this->chart->polarAreaChart()
            ->setTitle('Monthly Users')
            ->setSubtitle('For this year')
            ->addData($data)
            ->setLabels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);

    }

}