<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;

class InvoiceZip extends Notification
{
    use Queueable, SerializesModels, Broadcaster;

    private $zipname;
    private $start;
    private $end;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($zipname, $start, $end)
    {
        $this->zipname = $zipname;
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Thank you for using our application!')
            ->line('Your Invoice Zip '.$this->start.' To '.$this->end. ' Ready To Download.')
            ->attach($this->zipname);
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
            //
        ];
    }
}
