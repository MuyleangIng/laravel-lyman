<?php
namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MonthlyUsersChart
{
    protected $chart;
    protected $year;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
        $this->year = date('Y');
    }
    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    public function build($year = null)
    {
        // Use the current year if none is provided
        $year = $year ?? date('Y');

        $users = User::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
                    ->whereYear('created_at',  $this->year)
                    ->groupBy(DB::raw("MONTH(created_at)"), DB::raw("MONTHNAME(created_at)"))
                    ->orderBy(DB::raw("MONTH(created_at)"))
                    ->pluck('count', 'month_name')
                    ->toArray(); 

        return $this->chart->pieChart()
            ->setTitle('New Users - ' . $year)
            ->setDataset(array_values($users)) 
            ->setLabels(array_keys($users)); 
    }
}

