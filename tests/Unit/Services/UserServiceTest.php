<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\User\UserReader;
use App\Repositories\User\MixedUserRepository;
use Illuminate\Support\Collection;
use App\Models\Customer;

class UserServiceTest extends TestCase
{
    private $mixedRepository;
    
    private UserReader $sut;
    
    public function setUp(): void
    {
        parent::setUp();
        
        $this->mixedRepository = $this->prophesize(MixedUserRepository::class);
        $this->mixedRepository->readRecentUsers()->willReturn($this->generateFakeData());
        
        $this->sut = new UserReader($this->mixedRepository->reveal());
    }
    
    /**
     * @test
     */
    public function itCallsTheRepository()
    {
        $this->sut->readRecentUsers();
        
        $this->mixedRepository->readRecentUsers()->shouldHaveBeenCalled();
    }
    
    /**
     * @test
     */
    public function itCallsTheRepoAndRetrievesACollection()
    {
        $this->assertCollection($this->sut->readRecentUsers());
    }
    
    /**
     * @test
     */
    public function itContaisCustomerModels()
    {
        $result = $this->sut->readRecentUsers();
        
        foreach ($result as $sut) {
            $this->assertInstanceOf(Customer::class, $sut);
        }
    }
    
    private function generateFakeData(): Collection
    {
        $users = $this->faker->numberBetween(5, 10);
        $data = new Collection();
        
        foreach (range(1, $users) as $id) {
            $data->push(new Customer(
                $id,
                $this->faker->name,
                $this->faker->email,
                $this->faker->phoneNumber,
                $this->faker->company
            ));
        }
        
        return $data;
    }
}
