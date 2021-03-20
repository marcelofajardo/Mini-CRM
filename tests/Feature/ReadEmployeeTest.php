<?php

namespace Tests\Feature;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReadEmployeeTest extends TestCase
{
    use RefreshDatabase;

    private $employee;

    public function setUp() : void
    {
        parent::setUp();

        $this->employee = Employee::factory()->create();
    }

    public function test_an_unauthenticated_user_cannot_view_employees_page() 
    {
        $this->get(route('employees.index'))
            ->assertRedirect(route('login'));
    }

    public function test_an_authenticated_user_can_view_all_employees()
    {
        $this->signIn();

        $this->get(route('employees.index'))
            ->assertStatus(200)
            ->assertSee($this->employee->name);
    }

    public function test_an_authenticated_user_can_view_single_employee()
    {
        $this->signIn();

        $this->get(route('employees.show', ['employee' => $this->employee->id]))
            ->assertStatus(200)
            ->assertSee($this->employee->name);
    }

    public function test_an_authenticated_user_cannot_view_non_existing_employee()
    {
        $this->signIn();
        
        $this->get(route('employees.show', ['employee' => 999]))
            ->assertNotFound();
    }
}
