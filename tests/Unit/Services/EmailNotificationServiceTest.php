<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\EmailNotificationService;
use Prophecy\Argument;
use Illuminate\Config\Repository as Config;

class EmailNotificationServiceTest extends TestCase
{
    private const ADMIN_EMAIL_KEY = 'app.admin_email';
    private const ADMIN_EMAIL = 'test@test.com';
    
    private $config;
    private $mailer;
    
    private EmailNotificationService $sut;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->mailer = $this->swapMailer(self::ADMIN_EMAIL);
        
        $this->config = $this->prophesize(Config::class);
        $this->config->get(self::ADMIN_EMAIL_KEY)->willReturn(self::ADMIN_EMAIL);
        
        $this->sut = new EmailNotificationService(
            $this->config->reveal(),
            $this->mailer->reveal()
        );
    }
    
    /**
     * @test
     */
    public function itSendsAnEmailToTheAdminUser()
    {
        $fileName = 'test.csv';
        
        $this->sut->notifyAdminUser($fileName);
        
        $this->mailer->send(Argument::cetera())->shouldHaveBeenCalled();
    }
}
