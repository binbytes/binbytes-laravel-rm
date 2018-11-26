<?php

namespace App\Events;

use App\Salary;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SalaryPaid
{
    use Dispatchable, SerializesModels;

    public $salary;
    public $fileName;

    /**
     * Create a new event instance.
     *
     * @param Salary $salary
     */
    public function __construct(Salary $salary, $fileName)
    {
        $this->salary = $salary;
        $this->fileName = $fileName;
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
