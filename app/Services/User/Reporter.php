<?php declare(strict_types = 1);

namespace App\Services\User;

use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Collection;
use App\Models\Customer;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Reporter
{
    private const FILENAME = 'report_';
    private const FILE_EXTENSION = '.csv';
    
    private FilesystemManager $fileSystem;
    
    public function __construct(FilesystemManager $fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }
    
    public function generateReport(Collection $users): string
    {
        $data = $this->mapUsers($users);
        
        return $this->saveFileFromData($data);
    }
    
    public function mapUsers(Collection $users): Collection
    {
        return $users->map(fn(Customer $user) => [
            'id' => $user->id(),
            'name' => $user->name(),
            'email' => $user->email(),
            'phone' => $user->phone(),
            'company' => $user->company()
        ]);
    }
    
    private function generateName(): string
    {
        $timestamp = Carbon::now()->toDateTimeString();
        
        return Str::of('reports/' . self::FILENAME)
                ->append($timestamp)
                ->replace(' ', '_')
                ->append(self::FILE_EXTENSION)
                ->__toString();
    }
    
    private function saveFileFromData(Collection $data): string
    {
        $handle = fopen('php://temp', 'w+b');
        fputcsv($handle, [
            'ID', 'Name', 'Email', 'Phone', 'Company'
        ]);
        
        $data->each(function (array $user) use ($handle) {
            fputcsv($handle, $user);
        });
        
        $reportName = $this->generateName();
        $this->fileSystem->put($reportName, $handle);
        
        fclose($handle);
        
        return $reportName;
    }
}
