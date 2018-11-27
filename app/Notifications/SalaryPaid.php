<?php

namespace App\Notifications;

use App\Salary;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;

class SalaryPaid extends Notification
{
    use Queueable, SerializesModels;

    protected $salary;

    /**
     * Create a new notification instance.
     *
     * @param \App\Salary $salary
     */
    public function __construct(Salary $salary)
    {
        $this->salary = $salary;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/salaries/'. $this->salary->user_id);

        return (new MailMessage)
            ->subject('Your salary has been paid')
            ->markdown('mail.salary.paid', [
                'salary' => $this->salary,
                'url' => $url
            ])
            ->attachData($this->salary->paySlipPDF()->output(), $this->salary->paySlipFileName());
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
            'id' => $this->salary->id,
            'user_id'=> $this->salary->user_id,
            'base_salary' => $this->salary->base_salary,
            'paid_amount' => $this->salary->paid_amount,
            'paid_for'=> $this->salary->paid_for->toDateString(),
            'pf' => $this->salary->pf,
            'tds' => $this->salary->tds,
            'bonus' => $this->salary->bonus,
            'penalty' => $this->salary->penalty,
        ];
    }
}
