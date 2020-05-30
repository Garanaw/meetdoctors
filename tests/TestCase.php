<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Illuminate\Mail\Mailer;
use Prophecy\Argument;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use WithFaker;
    
    protected function swapMailer($adminEmail): object
    {
        $mailer = $this->prophesize(Mailer::class);
        $mailer->to($adminEmail)->willReturn($mailer);
        $mailer->send(Argument::cetera())->will(function () {});
        
        $this->swap(Mailer::class, $mailer);
        
        return $mailer;
    }
    
    protected function assertCollection($result): void
    {
        $this->assertTrue($result instanceof Collection);
    }
}
