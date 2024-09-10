<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cause;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CauseReportNotification;
use Carbon\Carbon;

class SendCauseReports extends Command
{
    protected $signature = 'reports:send';
    protected $description = 'Send report notifications based on cause timeline';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = now();
        
        // Notify for initial report (e.g., 7 days after start_date)
        $initialReportDaysAfter = 7; // You can change this
        $causesForInitialReport = Cause::whereDate('start_date', '=', $today->subDays($initialReportDaysAfter))->get();
        foreach ($causesForInitialReport as $cause) {
            Notification::send($cause->user, new CauseReportNotification($cause, 'Initial'));
        }

        // Notify for progress report (e.g., halfway through the timeline)
        $causesForProgressReport = Cause::whereDate('start_date', '<', $today)
            ->whereDate('end_date', '>', $today)
            ->get();
        
        foreach ($causesForProgressReport as $cause) {
            $startDate = Carbon::parse($cause->start_date);
            $endDate = Carbon::parse($cause->end_date);
            $halfwayPoint = $startDate->addDays($startDate->diffInDays($endDate) / 2);

            // If today is the halfway point, send the progress report
            if ($today->isSameDay($halfwayPoint)) {
                Notification::send($cause->user, new CauseReportNotification($cause, 'Progress'));
            }
        }

        // Notify for final report (e.g., 5 days before end_date)
        $finalReportDaysBefore = 5; // You can change this
        $causesForFinalReport = Cause::whereDate('end_date', '=', $today->addDays($finalReportDaysBefore))->get();
        foreach ($causesForFinalReport as $cause) {
            Notification::send($cause->user, new CauseReportNotification($cause, 'Final'));
        }

        $this->info('Report notifications sent successfully.');
    }
}
