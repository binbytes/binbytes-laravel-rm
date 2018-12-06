<?php

namespace App\Console\Commands;

use App\Jobs\AddCreditJob;
use App\Leave;
use Illuminate\Console\Command;

class LeaveCredit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leave:credit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add approved leave credit to user account.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = today()->subDay(1);
        $leaves = Leave::with('user')
            ->whereHas('user')
            ->where('start_date', '>=', $date)
            ->where('end_date', '>=', $date)
            ->where('is_approved', true)
            ->get();

        foreach ($leaves as $leave) {
            dispatch(
                (new AddCreditJob($leave->user, $leave, $date))
            );
        }
    }
}
