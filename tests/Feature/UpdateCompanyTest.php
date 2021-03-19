<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UpdateCompanyTest extends TestCase
{
    use RefreshDatabase;

    private $company;

    public function setUp(): void
    {  
        parent::setUp();

        $this->company = Company::factory()->create();
    }

    public function test_an_unauthenticated_user_cannot_view_the_edit_company_page() 
    {
        $this->get(route('companies.edit', ['company' => $this->company->id]))
            ->assertRedirect(route('login'));
    }

    public function test_an_authenticated_user_can_view_the_edit_company_page() 
    {
        $this->be(User::factory()->create());

        $this->get(route('companies.edit', ['company' => $this->company->id]))
            ->assertStatus(200)
            ->assertSeeInOrder(["Editing", 'Name', 'Email', 'Logo', 'Website']);    
    }

    public function test_a_non_administrator_cannot_update_a_company() 
    {
        $this->put(route('companies.update', ['company' => $this->company->id]), [])
            ->assertRedirect(route('login'));
    }

    public function test_a_company_must_have_name() 
    {
        $this->be(User::factory()->administrator()->create());

        $company = Company::factory()->make(['name' => null]);

        $this->put(route('companies.update', ['company' => $this->company->id]), $company->toArray())
            ->assertSessionHasErrors('name');
    }
    
    public function test_a_company_must_have_email() 
    {
        $this->be(User::factory()->administrator()->create());

        $company = Company::factory()->make(['email' => null]);

        $this->put(route('companies.update', ['company' => $this->company->id]), $company->toArray())
            ->assertSessionHasErrors('email');
    }

    public function test_a_company_must_have_website() 
    {
        $this->be(User::factory()->administrator()->create());

        $company = Company::factory()->make(['website' => null]);

        $this->put(route('companies.update', ['company' => $this->company->id]), $company->toArray())
            ->assertSessionHasErrors('website');
    }

    public function test_an_administrator_can_update_a_company()
    {
        $file = UploadedFile::fake()->image('logo.png', 101, 101);

        $this->be(User::factory()->administrator()->create());

        $company = Company::factory()->make(['logo' => $file]);

        $this->put(route('companies.update', ['company' => $this->company->id ]), $company->toArray())
            ->assertStatus(302);
    }
}
