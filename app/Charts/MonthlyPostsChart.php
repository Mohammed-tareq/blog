<?php

namespace App\Charts;

use App\Models\Post;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use \ArielMejiaDev\LarapexCharts\LineChart;

class MonthlyPostsChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): LineChart
    {
        $data = [];
        for ($m = 1; $m <= 12; $m++) {
            $data[] = Post::whereYear('created_at',now()->year)->whereMonth('created_at', $m)->count();
        }

        return $this->chart->lineChart()
            ->setTitle('Monthly Posts')
            ->setSubtitle('For this year')
            ->addData('Posts', $data)
            ->setXAxis(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);

    }
}