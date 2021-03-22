<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class CompanyAndEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = Company::factory(10)->create();

        foreach($companies as $company) {
            Employee::factory(5)->create([
                'company' => $company->id
            ]);
        }
    }
}
