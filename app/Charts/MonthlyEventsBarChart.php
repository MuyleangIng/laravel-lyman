<?php
namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class MonthlyEventsBarChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        // Fetch the count of all events grouped by month
        $allEvents = Event::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
                          ->groupBy(DB::raw("MONTH(created_at)"), 'month_name')
                          ->orderBy(DB::raw("MONTH(created_at)"))
                          ->pluck('count', 'month_name')
                          ->toArray();
        
        // Fetch the count of free events grouped by month
        $freeEvents = Event::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
                           ->where('price', 0)
                           ->groupBy(DB::raw("MONTH(created_at)"), 'month_name')
                           ->orderBy(DB::raw("MONTH(created_at)"))
                           ->pluck('count', 'month_name')
                           ->toArray();

        // Ensure both datasets have the same keys (months) by filling missing months with 0
        $months = array_keys(array_merge($allEvents, $freeEvents));
        $allEvents = array_replace(array_fill_keys($months, 0), $allEvents);
        $freeEvents = array_replace(array_fill_keys($months, 0), $freeEvents);

        return $this->chart->barChart()
            ->setTitle('Events by Month - ' . date('Y'))
            ->setSubtitle('Monthly event counts for ' . date('Y'))
            ->setDataset([
                ['name' => 'All Events', 'data' => array_values($allEvents)],
                ['name' => 'Free Events', 'data' => array_values($freeEvents)]
            ])
            ->setXAxis($months)
            ->setColors(['#3490dc', '#38c172'])
            ->setGrid(true);
    }
}
