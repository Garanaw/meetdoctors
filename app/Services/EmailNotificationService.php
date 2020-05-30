<?php declare(strict_types = 1);

namespace App\Services;

use Illuminate\Config\Repository as Config;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Mail\Mailer;
use App\Mail\ReportGenerated;

class EmailNotificationService
{
    private Config $config;
    private FileSystemManager $fileSystem;
    private Mailer $mailer;

    public function __construct(Config $config, FilesystemManager $fileSystem, Mailer $mailer)
    {
        $this->config = $config;
        $this->fileSystem = $fileSystem;
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
