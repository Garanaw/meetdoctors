<?php declare(strict_types = 1);

namespace App\Services\User;

use App\Repositories\User\UserRepository;
use Illuminate\Support\Collection;

class UserReader
{
    private UserRepository $repository;
    
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    
    public function readRecentUsers(): Collection
    {
        return $this->repository->readRecentUsers();
    }
}
