<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Cause;
use Carbon\Carbon;

class CauseReportNotification extends Notification
{
    use Queueable;

    protected $cause;
    protected $reportType;

    /**
     * Create a new notification instance.
     */
    public function __construct(Cause $cause, $reportType)
    {
        $this->cause = $cause;
        $this->reportType = $reportType;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $subject = $this->reportType . ' Report Reminder for Your Project';

        // Convert start_date and end_date strings to Carbon instances
        $startDate = Carbon::parse($this->cause->start_date);
        $endDate = Carbon::parse($this->cause->end_date);

        return (new MailMessage)
            ->subject($subject)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('This is a reminder to submit your ' . $this->reportType . ' report for the project "' . $this->cause->name . '".')
            ->line('Start date: ' . $startDate->toFormattedDateString())
            ->line('End date: ' . $endDate->toFormattedDateString())
            ->action('View Project Details', url('/causes/' . $this->cause->slug))
            ->line('Thank you for your commitment!');
    }
}
