<?php

namespace Tests\Unit;

use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    private $company;

    public function setUp (): void
    {
        parent::setUp();
        $this->company = Company::factory()->create();
    }

    public function test_a_company_has_employees() 
    {
        $this->assertInstanceOf(Collection::class, $this->company->employees);
    }
}
