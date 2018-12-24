<?php

namespace App\Events;

use App\Holiday;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class HolidayAdded
{
    use Dispatchable, SerializesModels;

    /**
     * @var Holiday
     */
    public $holiday;

    /**
     * Create a new event instance.
     *
     * @param Holiday $holiday
     */
    public function __construct(Holiday $holiday)
    {
        $this->holiday = $holiday;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('holiday');
    }
}
