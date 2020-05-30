<?php declare(strict_types = 1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

class ReportGenerated extends Mailable
{
    use Queueable;
    
    private string $report;

    /**
     * @return void
     */
    public function __construct(string $report)
    {
        $this->report = $report;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.report_generated')
            ->attachFromStorage($this->report);
    }
}
