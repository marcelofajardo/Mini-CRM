<?php

namespace Tests\Feature;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateEmployeeTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_unauthenticated_user_cannot_view_the_create_employee_page()
    {
        $this->get(route('employees.create'))
            ->assertRedirect(route('login'));
    }

    public function test_a_non_administrator_cannot_view_the_create_employee_page()
    {
        $this->signIn();

        $this->get(route('employees.create'))
            ->assertStatus(403);
    }

    public function test_an_administrator_can_view_the_create_employee_page()
    {
        $this->signIn(true);

        $this->get(route('employees.create'))
            ->assertStatus(200)
            ->assertSeeInOrder(['Create a new employee', 'First Name', 'Last Name', 'Company', 'Email', 'Phone']);
    }

    public function test_a_non_administrator_cannot_create_a_employee()
    {
        $this->post(route('employees.store'), [])
            ->assertRedirect(route('login'));
    }

    public function test_a_employee_must_have_first_name()
    {
        $this->signIn(true);

        $employee = Employee::factory()->make(['first_name' => null]);

        $this->post(route('employees.store'), $employee->toArray())
            ->assertSessionHasErrors('first_name');
    }

    public function test_a_employee_must_have_last_name()
    {
        $this->signIn(true);

        $employee = Employee::factory()->make(['last_name' => null]);

        $this->post(route('employees.store'), $employee->toArray())
            ->assertSessionHasErrors('last_name');
    }
    
    public function test_a_employee_must_have_company()
    {
        $this->signIn(true);

        $employee = employee::factory()->make(['company' => null]);

        $this->post(route('employees.store'), $employee->toArray())
            ->assertSessionHasErrors('company');
    }

    public function test_a_employee_must_have_email()
    {
        $this->signIn(true);

        $employee = Employee::factory()->make(['email' => null]);

        $this->post(route('employees.store'), $employee->toArray())
            ->assertSessionHasErrors('email');
    }

    public function test_a_employee_must_have_phone()
    {
        $this->signIn(true);

        $employee = Employee::factory()->make(['phone' => null]);

        $this->post(route('employees.store'), $employee->toArray())
            ->assertSessionHasErrors('phone');
    }

    public function test_an_administrator_can_create_a_employee()
    {
        $this->signIn(true);

        $employee = Employee::factory()->make();

        $this->post(route('employees.store'), $employee->toArray())
            ->assertStatus(302);

        $this->assertDatabaseCount('employees', 1);
    }
}
