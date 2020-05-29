<?php declare(strict_types = 1);

namespace App\Repositories\User;

use Illuminate\Support\Collection;

class HttpUserRepository implements UserRepository
{
    public function readRecentUsers(): Collection
    {
        dump('reading http');
        return new Collection();
    }

}
