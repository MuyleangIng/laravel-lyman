<?php
namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MonthlyUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $users = User::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("MONTH(created_at)"), DB::raw("MONTHNAME(created_at)"))
                    ->orderBy(DB::raw("MONTH(created_at)"))
                    ->pluck('count', 'month_name')
                    ->toArray();  // Ensure this is an array

        return $this->chart->pieChart()
            ->setTitle('New Users - ' . date('Y'))
            ->setDataset(array_values($users)) 
            ->setLabels(array_keys($users)); 
    }
}
