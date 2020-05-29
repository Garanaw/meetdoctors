<?php declare(strict_types = 1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Config\Repository as Config;
use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Carbon;

class CreateTestUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    
    private Config $config;
    private Hasher $hasher;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Config $config, Hasher $hasher)
    {
        parent::__construct();
        $this->config = $config;
        $this->hasher = $hasher;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        $this->generateUser()->save();
        $this->info('User generated');
    }
    
    private function generateUser(): User
    {
        return new User([
            'name' => $this->config->get('app.test_user.name'),
            'email' => $this->config->get('app.test_user.email'),
            'password' => $this->hasher->make($this->config->get('app.test_user.password')),
            'email_verified_at' => Carbon::now()
        ]);
    }
}
