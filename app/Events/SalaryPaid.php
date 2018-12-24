<?php

namespace App\Events;

use App\Salary;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class SalaryPaid
{
    use Dispatchable, SerializesModels;

    /**
     * @var \App\Salary
     */
    public $salary;

    /**
     * Create a new event instance.
     *
     * @param Salary $salary
     */
    public function __construct(Salary $salary)
    {
        $this->salary = $salary;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('salary-paid');
    }
}
