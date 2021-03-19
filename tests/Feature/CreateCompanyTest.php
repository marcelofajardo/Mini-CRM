<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreateCompanyTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_unauthenticated_user_cannot_view_the_create_company_page()
    {
        $this->get(route('companies.create'))
            ->assertRedirect(route('login'));
    }

    public function test_an_authenticated_user_can_view_the_create_company_page()
    {
        $this->be(User::factory()->create());

        $this->get(route('companies.create'))
            ->assertStatus(200)
            ->assertSeeInOrder(['Create a new company', 'Name', 'Email', 'Logo', 'Website']);
    }

    public function test_a_non_administrator_cannot_create_a_company()
    {
        $this->post(route('companies.store'), [])
            ->assertRedirect(route('login'));
    }

    public function test_a_company_must_have_name()
    {
        $this->be(User::factory()->administrator()->create());

        $company = Company::factory()->make(['name' => null]);

        $this->post(route('companies.store'), $company->toArray())
            ->assertSessionHasErrors('name');
    }

    public function test_a_company_must_have_email()
    {
        $this->be(User::factory()->administrator()->create());

        $company = Company::factory()->make(['email' => null]);

        $this->post(route('companies.store'), $company->toArray())
            ->assertSessionHasErrors('email');
    }

    public function test_a_company_must_have_logo()
    {
        $this->be(User::factory()->administrator()->create());

        $company = Company::factory()->make(['logo' => null]);

        $this->post(route('companies.store'), $company->toArray())
            ->assertSessionHasErrors('logo');
    }


    public function test_a_company_must_have_website()
    {
        $this->be(User::factory()->administrator()->create());

        $company = Company::factory()->make(['website' => null]);

        $this->post(route('companies.store'), $company->toArray())
            ->assertSessionHasErrors('website');
    }

    public function test_an_administrator_can_create_a_company()
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('logo.png', 100, 100);

        $this->be(User::factory()->administrator()->create());

        $company = Company::factory()->make(['logo' => $file]);

        $this->withoutExceptionHandling()->post(route('companies.store'), $company->toArray())
            ->assertStatus(302);

        $this->assertDatabaseCount('companies', 1);

        Storage::disk('public')->assertExists('upload/'. $file->hashName());
    }
}
