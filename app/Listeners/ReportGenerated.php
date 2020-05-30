<?php declare(strict_types = 1);

namespace App\Listeners;

use App\Events\ReportGenerated as Event;
use App\Services\EmailNotificationService as Service;

class ReportGenerated
{
    private Service $service;
    
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function handle(Event $event)
    {
        $this->service->notifyAdminUser($event->fileName());
    }
}
