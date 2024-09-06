<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Cause;
use Illuminate\Support\Facades\DB;

class MonthlyCausesAreaChart
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

        // Fetch causes grouped by month and their counts
        $causes = Cause::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at',  $this->year)
            ->groupBy(DB::raw("MONTH(created_at)"), DB::raw("MONTHNAME(created_at)"))
            ->orderBy(DB::raw("MONTH(created_at)"))
            ->get();

        // Prepare data arrays
        $counts = [];
        $months = [];

        foreach ($causes as $cause) {
            $counts[] = $cause->count;
            $months[] = $cause->month_name;
        }

        // Handle empty data
        if (empty($counts) || empty($months)) {
            $counts = [0]; // Avoid passing empty arrays
            $months = ['No Data'];
        }

        // Return the area chart with dynamic data
        return $this->chart->areaChart()
            ->setTitle('New Projects - ' . $year)
            ->setDataset([[
                'name' => 'Projects',
                'data' => $counts
            ]])
            ->setLabels($months);
    }
}

