<?php

namespace App\Jobs;

use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AddCreditJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \App\User
     */
    private $user;

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    private $type;

    /**
     * AddCreditJob constructor.
     *
     * @param \App\User $user
     * @param \Illuminate\Database\Eloquent\Model $type
     */
    public function __construct(User $user, Model $type)
    {
        $this->user = $user;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $date = today()->subDay(1);
        if ($date->diffInDays($this->type->start_date)  == 0 && $this->type->start_date_partial_hours) {
            $this->createPartialHourAttendance($date, $this->type->start_date_partial_hours);
        } elseif ($date->diffInDays($this->type->end_date) == 0 && $this->type->end_date_partial_hours) {
            $this->createPartialHourAttendance($date, $this->type->end_date_partial_hours);
        } else {
            $this->createPartialHourAttendance($date, 8);
        }
    }

    /**
     * @param \Carbon\Carbon $date
     * @param $hour
     *
     * @return \App\UserAttendance
     */
    protected function createPartialHourAttendance(Carbon $date, $hour)
    {
        $attandance = $this->user->attendanceOfTheDay($date);
        if (! $attandance) {
            $attandance = $this->user->createAttendance($date);
        }

        $attandance->createAttandanceSession(
            $this->type,
            $this->user,
            $date,
            $hour
        );

        return $attandance;
    }
}
