<?php declare(strict_types = 1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\User\UserReader;
use App\Services\User\Reporter;
use Illuminate\Support\Collection;
use Illuminate\Events\Dispatcher;

class ReadUsers extends Command
{
    /**
     * @var string
     */
    protected $signature = 'users:read';

    /**
     * @var string
     */
    protected $description = 'Read the users provided by the companies and the users from the service and generates a CSV file';
    
    private UserReader $userReader;
    private Reporter $reporter;
    private Dispatcher $dispatcher;

    /**
     * @return void
     */
    public function __construct(
        UserReader $userReader,
        Reporter $reporter,
        Dispatcher $dispatcher
    ) {
        parent::__construct();
        $this->userReader = $userReader;
        $this->reporter = $reporter;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        $users = $this->userReader->readRecentUsers();
        
        $reportName = $this->reporter->generateReport($users);
        
        $this->generateReport($users);
        
        $this->dispatcher->dispatch($event, $users);
    }
    
    private function generateReport(Collection $users): void
    {
        $result = $this->reporter->mapUsers($users);
        
        $this->table([
            'ID', 'Name', 'Email', 'Phone', 'Company'
        ], $result->toArray());
    }
}
