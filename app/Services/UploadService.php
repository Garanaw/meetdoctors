<?php declare(strict_types = 1);

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class UploadService
{
    private const FILENAME = 'users_';
    private const FILE_EXTENSION = '.xml';
    
    public function storeUsersFile(UploadedFile $file): void
    {
        $file->storeAs('users', $this->generateName());
    }
    
    private function generateName(): string
    {
        $timestamp = Carbon::now()->toDateTimeString();
        
        return Str::of(self::FILENAME)
            ->append($timestamp)
            ->replace(' ', '_')
            ->append(self::FILE_EXTENSION)
            ->__toString();
    }
}
