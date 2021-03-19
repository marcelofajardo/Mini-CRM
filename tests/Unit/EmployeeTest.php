<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;
    
    private $employee;

    public function setUp(): void 
    {
        parent::setUp();
        $this->employee = Employee::factory()->create();
    }

    public function test_an_employee_belongs_to_a_company()
    {
        $this->assertInstanceOf(Company::class, $this->employee->companyRel);
    }
}
