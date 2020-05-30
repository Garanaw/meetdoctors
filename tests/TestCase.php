<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use WithFaker;
    
    protected function assertCollection($result): void
    {
        $this->assertTrue($result instanceof Collection);
    }
}
