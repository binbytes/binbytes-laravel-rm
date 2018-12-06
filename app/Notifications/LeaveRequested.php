<?php

namespace App\Notifications;

use App\Leave;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;

class LeaveRequested extends Notification
{
    use Queueable, SerializesModels, Broadcaster;

    /**
     *@var Leave
     */
    protected $leave;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Leave $leave)
    {
        $this->leave = $leave;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/leaves/'. $this->leave->id);

        return (new MailMessage)
            ->subject('Leave Request')
            ->markdown('mail.leave.request', [
                'leave' => $this->leave,
                'url'=> $url
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id' => $this->leave->id,
            'user_id' => $this->leave->user_id,
            'requested_by' => $this->leave->user->name,
            'subject' => $this->leave->subject,
            'description' => $this->leave->description,
            'start_date'=> $this->leave->start_date->toDateString(),
            'end_date' => $this->leave->end_date->toDateString()
        ];
    }
}
