<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Cause;
use Illuminate\Support\Facades\DB;

class MonthlyCausesAreaChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        // Fetch causes grouped by month and their counts
        $causes = Cause::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
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

        // Ensure data consistency and handle empty data
        if (empty($counts) || empty($months)) {
            // Handle the case where there's no data
            $counts = [0]; // Avoid passing empty arrays
            $months = ['No Data'];
        }

        // Return the area chart with dynamic data
        return $this->chart->areaChart()
            ->setTitle('New Causes - ' . date('Y'))
            ->setDataset([[
                'name' => 'Causes',
                'data' => $counts
            ]])
            ->setLabels($months);
    }
}

