<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteCompanyTest extends TestCase
{
    use RefreshDatabase;

    private $company;

    public function setUp(): void {
        parent::setUp();

        $this->company = Company::factory()->create();
    }

    public function test_an_unauthenticated_user_cannot_delete_a_company()
    {
        $this->delete(route('companies.destroy', ['company' => $this->company->id ]))
            ->assertRedirect(route('login'));
    }

    public function test_an_administrator_can_delete_a_company()
    {
        $this->signIn(true);

        $this->delete(route('companies.destroy', ['company' => $this->company->id ]))
            ->assertStatus(302);

        $this->assertDatabaseCount('companies', 0);
    }

    public function test_an_administrator_cannot_delete_a_non_existing_company()
    {
        $this->signIn(true);

        $this->delete(route('companies.destroy', ['company' => 999 ]))
            ->assertStatus(404);

        $this->assertDatabaseCount('companies', 1);
    }
}
