<?php

namespace App\Jobs;

use App\Notifications\InvoiceZip;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class InvoicePdfDownload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $bills;
    private $user;
    private $start;
    private $end;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($bills, $user, $start, $end)
    {
        $this->bills = $bills;
        $this->user = $user;
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path = storage_path('app/public/invoice_'.$this->start.'_to_'.$this->end);
        $zip = new \ZipArchive();
        $zipname =  $path.".zip";
        File::makeDirectory($path);

        if ($zip->open($zipname, \ZipArchive::CREATE | \ZipArchive::OVERWRITE)) {
            foreach ($this->bills as $bill) {
                $pdf = \PDF::loadView('letter.billPdf', ['bill' => $bill]);

                $prefix = $bill->project !== null ? $bill->project->invoice_prefix : 'BB';

                $filename = $path.'/Invoice-' . $prefix . '-' . $bill->id . '.pdf';

                $output = $pdf->output();

                file_put_contents($filename, $output);

                $zip->addFile($filename, ('Invoice-'. $prefix.'-'.$bill->id.'.pdf'));
            }

            $zip->close();
        }

        $this->user->notify(new InvoiceZip($zipname, $this->start, $this->end));

        File::deleteDirectory($path);
    }
}
