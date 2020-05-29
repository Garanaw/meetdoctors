<?php declare(strict_types = 1);

namespace App\Repositories\User;

use Illuminate\Support\Collection;

interface UserRepository
{
    public function readRecentUsers(): Collection;
}
