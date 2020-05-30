<?php declare(strict_types = 1);

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;

class ReportGenerated
{
    use Dispatchable;

    private string $fileName;
    
    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }
    
    public function fileName(): string
    {
        return $this->fileName;
    }
}
