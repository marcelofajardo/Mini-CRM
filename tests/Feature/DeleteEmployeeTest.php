<?php

namespace Tests\Feature;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteEmployeeTest extends TestCase
{
    use RefreshDatabase;

    private $employee;

    public function setUp(): void {
        parent::setUp();

        $this->employee = Employee::factory()->create();
    }

    public function test_an_unauthenticated_user_cannot_delete_a_employee()
    {
        $this->delete(route('employees.destroy', ['employee' => $this->employee->id ]))
            ->assertRedirect(route('login'));
    }

    public function test_an_administrator_can_delete_a_employee()
    {
        $this->signIn(true);

        $this->delete(route('employees.destroy', ['employee' => $this->employee->id ]))
            ->assertStatus(302);

        $this->assertDatabaseCount('employees', 0);
    }

    public function test_an_administrator_cannot_delete_a_non_existing_employee()
    {
        $this->signIn(true);

        $this->delete(route('employees.destroy', ['employee' => 999 ]))
            ->assertStatus(404);

        $this->assertDatabaseCount('employees', 1);
    }
}
