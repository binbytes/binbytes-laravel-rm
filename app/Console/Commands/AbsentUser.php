<?php

namespace App\Console\Commands;

use App\User;
use App\Holiday;
use Illuminate\Console\Command;

class AbsentUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'absent:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find absent user whoever not on leave and holiday.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = today()->subDay(1);
        $holiday = Holiday::whereDate('start_date', '<=', $date)
            ->whereDate('end_date', '>=', $date)
            ->count();

        //When it holiday. don't need to check for absent.
        if ($holiday) {
            return;
        }

        $users = User::whereDoesntHave('attendance', function ($query) use ($date) {
            $query->where('date', $date);
        })->doesntOnLeave($date)->get();

        foreach ($users as $user) {
            $user->createAbsent($date);
        }
    }
}
