<?php declare(strict_types = 1);

namespace App\Repositories\User;

use Illuminate\Support\Collection;

class FileUserRepository implements UserRepository
{
    public function readRecentUsers(): Collection
    {
        dump('reading file');
        return new Collection();
    }
}
