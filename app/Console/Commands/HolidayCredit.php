<?php

namespace App\Console\Commands;

use App\Holiday;
use App\Jobs\AddCreditJob;
use App\User;
use Illuminate\Console\Command;

class HolidayCredit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'holiday:credit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Holiday credit to all user account.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $today = today()->subDay(1);
        $holidays = Holiday::where('start_date', '>=', $today)
            ->where('end_date', '>=', $today)
            ->get();

        foreach ($holidays as $holiday) {
            User::chunk(20, function ($users) use ($holiday) {
                foreach ($users as $user) {
                    dispatch(
                        (new AddCreditJob($user, $holiday))
                    );
                }
            });
        }
    }
}
