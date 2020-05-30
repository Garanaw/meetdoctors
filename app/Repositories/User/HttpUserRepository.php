<?php declare(strict_types = 1);

namespace App\Repositories\User;

use Illuminate\Config\Repository as Config;
use Illuminate\Http\Client\Factory as HttpClient;
use App\Models\Customer;
use Illuminate\Support\Collection;
use Throwable;

class HttpUserRepository implements UserRepository
{
    private Config $config;
    private HttpClient $client;
    
    public function __construct(Config $config, HttpClient $client)
    {
        $this->config = $config;
        $this->client = $client;
    }
    
    public function readRecentUsers(): Collection
    {
        try {
            $result = $this->getUsers();
            
            return $this->mapUsersToCustomers($result);
        } catch (Throwable $exception) {
            return new Collection();
        }
    }
    
    protected function getUsers(): Collection
    {
        $serviceUrl = $this->config->get('app.user_retriever_service');
        
        // Throw checks internally for a server error or client error to
        // actually throw an exception. Otherwise it returns the object
        $response = $this->client
            ->get($serviceUrl)
            ->throw();
        
        return new Collection($response->json());
    }
    
    protected function mapUsersToCustomers(Collection $users): Collection
    {
        return $users->map(fn(array $data) => new Customer(
            $data['id'],
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['company']['name']
        ));
    }
}
