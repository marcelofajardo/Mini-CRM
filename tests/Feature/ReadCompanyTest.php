<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReadCompanyTest extends TestCase
{
    use RefreshDatabase;

    private $company;

    public function setUp(): void 
    {
        parent::setUp();

        $this->company = Company::factory()->create();
    }

    public function test_an_unauthenticated_user_cannot_view_companies_page() 
    {
        $this->get(route('companies.index'))
            ->assertRedirect(route('login'));
    }

    public function test_an_authenticated_user_can_view_all_companies()
    {
        $this->signIn();

        $this->get(route('companies.index'))
            ->assertStatus(200)
            ->assertSee($this->company->name);
    }

    public function test_an_authenticated_user_can_view_single_company()
    {
        $this->signIn();

        $this->get(route('companies.show', ['company' => $this->company->id]))
            ->assertStatus(200)
            ->assertSee($this->company->name);
    }

    public function test_an_authenticated_user_cannot_view_non_existing_company()
    {
        $this->signIn();
        
        $this->get(route('companies.show', ['company' => 999]))
            ->assertNotFound();
    }
}
