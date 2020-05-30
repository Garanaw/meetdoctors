<?php declare(strict_types = 1);

namespace App\Repositories\User;

use Illuminate\Support\Collection;
use Illuminate\Filesystem\FilesystemManager;
use App\Models\Customer;
use DOMDocument;
use DOMElement;

class FileUserRepository implements UserRepository
{
    private FilesystemManager $fileSystem;
    
    public function __construct(FilesystemManager $fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }
    
    public function readRecentUsers(): Collection
    {
        $files = $this->fileSystem->files('users');
        
        return $this->processUsers($files);
    }
    
    private function processUsers(array $files)
    {
        $allUsers = new Collection();
        
        foreach ($files as $file) {
            $file = $this->fileSystem->get($file);
            
            $allUsers = $allUsers->merge($this->processUsersInFile($file));
        }
        
        return $allUsers;
    }
    
    private function processUsersInFile($file)
    {
        $xml = new DOMDocument('1.0');
        $xml->loadXML($file);
        $customers = new Collection();
        
        $clientsData = $xml->getElementsByTagName('reading');
        
        foreach ($clientsData as $client) {
            $customers->push($this->processUser($client));
        }
        
        return $customers;
    }
    
    private function processUser(DOMElement $node)
    {
        $data = [
            'email' => $node->firstChild->nodeValue
        ];
        
        foreach ($node->attributes as $key => $value) {
            if ($key === 'clientID') {
                $key = 'id';
            }
            $data[$key] = $value->value;
        }
        
        return new Customer(
            (int)$data['id'],
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['company']
        );
    }
}
