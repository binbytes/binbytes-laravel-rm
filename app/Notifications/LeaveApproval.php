<?php

namespace App\Notifications;

use App\Leave;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class LeaveApproval extends Notification
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
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/leaves/'.$this->leave->id);

        return (new MailMessage)
            ->subject('Your Leave Request has been '.$this->leave->approval_status)
            ->markdown('mail.leave.approval', [
                'leave' => $this->leave,
                'url'=> $url,
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
            'subject' => $this->leave->subject,
            'description' => $this->leave->description,
            'start_date'=> $this->leave->start_date->toDateString(),
            'end_date' => $this->leave->end_date->toDateString(),
            'is_approved' => $this->leave->is_approved,
            'approval_status' => $this->leave->approval_status,
            'approved_on' => $this->leave->approved_on->toDateString(),
        ];
    }
}
