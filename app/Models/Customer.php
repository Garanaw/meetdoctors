<?php declare(strict_types = 1);

namespace App\Models;

class Customer
{
    private int $id;
    private string $name;
    private string $email;
    private string $phone;
    private string $company;
    
    public function __construct(
        int $id,
        string $name,
        string $email,
        string $phone,
        string $company
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->company = $company;
    }
    
    public function name(): string
    {
        return $this->name;
    }
    
    public function email(): string
    {
        return $this->email;
    }
    
    public function phone(): string
    {
        return $this->phone;
    }
    
    public function company(): string
    {
        return $this->company;
    }
}
