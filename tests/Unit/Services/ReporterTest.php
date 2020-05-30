<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\User\Reporter;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ReporterTest extends TestCase
{
    private Reporter $sut;
    
    public function setUp(): void
    {
        parent::setUp();
        
        Storage::fake();
        $this->sut = new Reporter($this->app->make(FilesystemManager::class));
    }
    
    /**
     * @test
     */
    public function itUsesTheFileSystemToCreateTheReport()
    {
        $now = '2000-01-01 00:00:00';
        Carbon::setTestNow($now);
        
        $this->sut->generateReport(new Collection());
        
        $reportName = Str::of($now)
                ->prepend('reports/report_')
                ->replace(' ', '_')
                ->append('.csv');
        Storage::assertExists($reportName->__toString());
        
    }
}
