<?php
namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\CauseDonation;
use Illuminate\Support\Facades\DB;

class MonthlyCausesDonationsBarChart
{
    protected $chart;
    protected $year;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
        $this->year = date('Y'); // Default to current year
    }

    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    public function build()
    {
        $donations = CauseDonation::select(
                            DB::raw("SUM(price) as total_donations"), 
                            DB::raw("MONTHNAME(created_at) as month_name")
                        )
                        ->whereYear('created_at', $this->year)
                        ->groupBy(DB::raw("MONTH(created_at)"), DB::raw("MONTHNAME(created_at)"))
                        ->orderBy(DB::raw("MONTH(created_at)"))
                        ->pluck('total_donations', 'month_name')
                        ->toArray();

        $months = array_keys($donations);
        $totals = array_values($donations);

        if (empty($months)) {
            $months = ['No Data'];
            $totals = [0];
        }

        return $this->chart->barChart()
            ->setTitle('Donations by Month - ' . $this->year)
            ->setSubtitle('Total donations received per month for ' . $this->year)
            ->setDataset([
                ['name' => 'Total Donations', 'data' => $totals]
            ])
            ->setXAxis($months)
            ->setColors(['#3490dc'])
            ->setGrid(true);
    }
}
