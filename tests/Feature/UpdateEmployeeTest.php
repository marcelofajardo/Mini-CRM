<?php

namespace Tests\Feature;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateEmployeeTest extends TestCase
{
    use RefreshDatabase;

    private $employee;

    public function setUp(): void
    {  
        parent::setUp();

        $this->employee = Employee::factory()->create();
    }

    public function test_an_unauthenticated_user_cannot_view_the_edit_employee_page() 
    {
        $this->get(route('employees.edit', ['employee' => $this->employee->id]))
            ->assertRedirect(route('login'));
    }

    public function test_a_non_administrator_cannot_view_the_edit_employee_page() 
    {
        $this->signIn();

        $this->get(route('employees.edit', ['employee' => $this->employee->id]))
            ->assertStatus(403);
    }


    public function test_an_administrator_can_view_the_edit_employee_page() 
    {
        $this->signIn(true);

        $this->get(route('employees.edit', ['employee' => $this->employee->id]))
            ->assertStatus(200)
            ->assertSeeInOrder(["Editing", 'First Name', 'Last Name', 'Company', 'Email', 'Phone']);    
    }

    public function test_a_non_administrator_cannot_update_a_employee() 
    {
        $this->put(route('employees.update', ['employee' => $this->employee->id]), [])
            ->assertRedirect(route('login'));
    }

    public function test_a_employee_must_have_first_name() 
    {
        $this->signIn(true);

        $employee = Employee::factory()->make(['first_name' => null]);

        $this->put(route('employees.update', ['employee' => $this->employee->id]), $employee->toArray())
            ->assertSessionHasErrors('first_name');
    }

    public function test_a_employee_must_have_last_name() 
    {
        $this->signIn(true);

        $employee = Employee::factory()->make(['last_name' => null]);

        $this->put(route('employees.update', ['employee' => $this->employee->id]), $employee->toArray())
            ->assertSessionHasErrors('last_name');
    }

    public function test_a_employee_must_belongs_to_a_company() 
    {
        $this->signIn(true);

        $employee = Employee::factory()->make(['company' => null]);

        $this->put(route('employees.update', ['employee' => $this->employee->id]), $employee->toArray())
            ->assertSessionHasErrors('company');
    }
    
    public function test_a_employee_must_have_email() 
    {
        $this->signIn(true);

        $employee = Employee::factory()->make(['email' => null]);

        $this->put(route('employees.update', ['employee' => $this->employee->id]), $employee->toArray())
            ->assertSessionHasErrors('email');
    }

    public function test_a_employee_must_have_phone() 
    {
        $this->signIn(true);

        $employee = Employee::factory()->make(['phone' => null]);

        $this->put(route('employees.update', ['employee' => $this->employee->id]), $employee->toArray())
            ->assertSessionHasErrors('phone');
    }

    public function test_an_administrator_can_update_a_employee()
    {
        $this->signIn(true);

        $employee = Employee::factory()->make(['first_name' => 'John', 'last_name' => 'Doe']);

        $this->put(route('employees.update', ['employee' => $this->employee->id ]), $employee->toArray());

        $this->assertEquals($this->employee->fresh()->first_name, 'John');
        $this->assertEquals($this->employee->fresh()->last_name, 'Doe');
    }
}
