<?php declare(strict_types = 1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\User\UserReader;

class ReadUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:read';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Read the users provided by the companies and the users from the service and generates a CSV file';
    
    private UserReader $userReader;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserReader $userReader)
    {
        parent::__construct();
        $this->userReader = $userReader;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->userReader->readRecentUsers();
    }
}
