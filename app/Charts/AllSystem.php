<?php

namespace App\Charts;


use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use \ArielMejiaDev\LarapexCharts\pieChart;

class AllSystem
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build():pieChart
    {
        return $this->chart->pieChart()
        ->setTitle('All Data')
        ->setSubtitle('For this year')
        ->addData([
            Post::whereYear('created_at',now()->year)->count(),
            User::whereYear('created_at',now()->year)->count(),
            Category::whereYear('created_at',now()->year)->count(),
            Comment::whereYear('created_at',now()->year)->count()
        ])
        ->setLabels(['Posts', 'Users', 'Categories', 'Comments']);
    }

}