<?php declare(strict_types = 1);

namespace App\Services;

use Illuminate\Config\Repository as Config;
use Illuminate\Mail\Mailer;
use App\Mail\ReportGenerated;

class EmailNotificationService
{
    private Config $config;
    private Mailer $mailer;

    public function __construct(Config $config, Mailer $mailer)
    {
        $this->config = $config;
        $this->mailer = $mailer;
    }
    
    public function notifyAdminUser(string $fileName): void
    {
        $adminEmail = $this->config->get('app.admin_email');
        
        $this->mailer
            ->to($adminEmail)
            ->send(new ReportGenerated($fileName));
    }
}
