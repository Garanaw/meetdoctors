<?php declare(strict_types = 1);

namespace App\Repositories\User;

use Illuminate\Support\Collection;

class MixedUserRepository implements UserRepository
{
    private FileUserRepository $fileRepository;
    private HttpUserRepository $httpRepository;
    
    public function __construct(
        FileUserRepository $fileRepository,
        HttpUserRepository $httpRepository
    ) {
        $this->fileRepository = $fileRepository;
        $this->httpRepository = $httpRepository;
    }
    
    public function readRecentUsers(): Collection
    {
        $httpUsers = $this->readHttpUsers();
        $fileUsers = $this->readFileUsers();
        
        return $httpUsers->merge($fileUsers);
    }

    private function readHttpUsers(): Collection
    {
        return $this->httpRepository->readRecentUsers();
    }
    
    private function readFileUsers(): Collection
    {
        return $this->fileRepository->readRecentUsers();
    }
}
