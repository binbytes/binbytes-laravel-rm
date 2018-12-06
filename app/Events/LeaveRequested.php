<?php

namespace App\Events;

use App\Leave;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class LeaveRequested
{
    use Dispatchable, SerializesModels;

    /**
     * @var Leave
     */
    public $leave;

    /**
     * Create a new event instance.
     *
     * @param Leave $leave
     */
    public function __construct(Leave $leave)
    {
        $this->leave = $leave;
    }
}
