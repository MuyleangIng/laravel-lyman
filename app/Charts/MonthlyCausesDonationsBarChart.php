<?php
namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\CauseDonation;
use Illuminate\Support\Facades\DB;

class MonthlyCausesDonationsBarChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        // Fetch the total donation amounts grouped by month
        $donations = CauseDonation::select(
                            DB::raw("SUM(price) as total_donations"), 
                            DB::raw("MONTHNAME(created_at) as month_name")
                        )
                        ->whereYear('created_at', date('Y'))
                        ->groupBy(DB::raw("MONTH(created_at)"), DB::raw("MONTHNAME(created_at)"))
                        ->orderBy(DB::raw("MONTH(created_at)"))
                        ->pluck('total_donations', 'month_name')
                        ->toArray();

        // Prepare data for the chart
        $months = array_keys($donations);  // Get the months
        $totals = array_values($donations); // Get the total donations for each month

        // Handle case where no donations exist for some months
        if (empty($months)) {
            $months = ['No Data'];
            $totals = [0];
        }

        return $this->chart->barChart()
            ->setTitle('Donations by Month - ' . date('Y'))
            ->setSubtitle('Total donations received per month for ' . date('Y'))
            ->setDataset([
                ['name' => 'Total Donations', 'data' => $totals]
            ])
            ->setXAxis($months)
            ->setColors(['#3490dc'])
            ->setGrid(true);
    }
}
