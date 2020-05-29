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
        return $this->fileRepository
            ->readRecentUsers()
            ->merge(
                $this->httpRepository->readRecentUsers()
            );
    }

}
