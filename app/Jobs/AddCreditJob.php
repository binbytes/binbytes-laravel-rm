<?php

namespace App\Jobs;

use App\Holiday;
use App\User;
use App\UserAttendance;
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
     * @var \Carbon\Carbon
     */
    private $date;

    /**
     * AddCreditJob constructor.
     *
     * @param \App\User $user
     * @param \Illuminate\Database\Eloquent\Model $type
     * @param \Carbon\Carbon $date
     */
    public function __construct(User $user, Model $type, Carbon $date)
    {
        $this->user = $user;
        $this->type = $type;
        $this->date = $date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->date->diffInDays($this->type->start_date)  == 0 && $this->type->start_date_partial_hours) {
            $this->createPartialHourAttendance($this->type->start_date_partial_hours);
        } elseif ($this->date->diffInDays($this->type->end_date) == 0 && $this->type->end_date_partial_hours) {
            $this->createPartialHourAttendance($this->type->end_date_partial_hours);
        } else {
            $this->createPartialHourAttendance(8);
        }
    }

    /**
     * @param int $hour
     *
     * @return \App\UserAttendance
     */
    protected function createPartialHourAttendance($hour)
    {
        $attandance = $this->user->attendanceOfTheDay($this->date);
        if (! $attandance) {
            $attandance = $this->user->createAttendance($this->date, [
                'status' => $this->type instanceof Holiday ? UserAttendance::$HOLIDAY : UserAttendance::$LEAVE,
            ]);
        }

        $attandance->createAttandanceSession(
            $this->type,
            $this->user,
            $this->date,
            $hour
        );

        return $attandance;
    }
}
